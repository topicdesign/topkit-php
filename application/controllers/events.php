<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Events extends Public_Controller {

    /**
     * Constructor
     *
     * @access  public
     * @param   void
     *
     * @return  void
     **/
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('event');
    }

    // --------------------------------------------------------------------

    /**
     * re-route all URIs to internal methods
     *
     * @access  public
     * @param   string  $method     original requested method
     * @param   array   $params     passed paramaters
     *
     * @return  void
     **/
    public function _remap($method, $params = array())
    {
        // allow calling defined methods
        if (method_exists($this, $method))
        {
            // only call public methods
            $reflection = new ReflectionMethod($this, $method);
            if ( ! $reflection->isPublic())
            {
                show_404();
            }
            return call_user_func_array(array($this, $method), $params);
        }
        // $method is just the first param
        array_unshift($params, $method);
        // strip off page segment(s)
        $page = 1;
        $page_key = array_search('page', $params);
        if ($page_key !== FALSE)
        {
            $page = isset($params[$page_key + 1])
                ? $params[$page_key + 1]
                : 1;
            $params = array_slice($params, 0, $page_key);
        }
        // params shoud now be (YYYY,MM,DD,title)
        if (count($params) == 4)
        {
            return $this->view($params);
        }
        // clear params if default method call
        if ( ! empty($params) && $params[0] == 'index')
        {
            $params = array();
        }
        return $this->paginated($page, $params);
    }

    // --------------------------------------------------------------------

    /**
     * display an specifc event
     *
     * @access  private
     * @param   array       $params     passed params
     *
     * @return  void
     **/
    private function view($params)
    {
        // localize params (YYYY,MM,DD,title)
        $slug = array_pop($params);
        $TZ = new DateTimeZone(config_item('site_timezone'));
        $date = date_create(implode('-', $params), $TZ);
        // get the article
        $params = array(
            'date'      => $date,
            'slug'      => $slug,
            'published' => cannot('manage', 'event')
        );
        if ( ! $event = Event::find_event($params))
        {
            show_404();
        }
        $data['event'] = $event;

        $this->template
            ->title($event->title, 'Events', config_item('site_title')) 
            ->build('events/event_view.php', $data);
    }

    // --------------------------------------------------------------------

    /**
     * get an page of events to display as an index
     *
     * @access  private
     * @param   string      $page       page number
     * @param   array       $params     passed params
     *
     * @return  void
     **/
    private function paginated($page, $params)
    {
        $TZ = new DateTimeZone(config_item('site_timezone'));
        // set date limits based on params
        $title_segments = array('Events', config_item('site_title')); 
        switch (count($params))
        {
            case 1:
                // limit by year
                $params += array(1,1);
                $start = date_create(implode('-', $params), $TZ);
                $end = clone $start;
                $end->modify('+1 year');
                
                array_unshift($title_segments, $start->format('Y'));
                break;
            case 2:
                // limit by month
                $params += array(1);
                $start = date_create(implode('-', $params), $TZ);
                $end = clone $start;
                $end->modify('+1 month');

                array_unshift($title_segments, $start->format('F, Y'));
                break;
            case 3:
                // limit by day
                $start = date_create(implode('-', $params), $TZ);
                $end = clone $start;
                $end->modify('+1 day');

                array_unshift($title_segments, $start->format('F j, Y'));
                break;
            default:
                // no limit
                $start = $end = NULL;
                $title = NULL;
                break;
        }
        // get a page of articles 
        $per_page = 3;
        $config = array(
            'start' => $start,
            'end'   => $end,
            'published' => cannot('manage', 'event'),
            'per_page'  => $per_page,
            'page'      => $page
        );
        $result = Event::paginated($config);
        if ( ! $result->events)
        {
            show_404();
        }
        // setup pagination
        $segments = $this->uri->segment_array();
        if ($key = array_search('page', $segments))
        {
            $segments = array_slice($segments, 0, $key - 1);
        }
        array_push($segments, 'page');
        $this->load->library('pagify');
        $config = array(
            'total'    => $result->total_rows,
            'url'      => site_url($segments),
            'page'     => $page,
            'per_page' => $per_page
        );
        $this->pagify->initialize($config);
        // output the index
        $data = array(
            'events' => $result->events
        );
        // set title from prepared segments
        call_user_func_array(array($this->template, 'title'), $title_segments);
        $this->template
            //->title($title_segments)
            ->build('events/events_index.php', $data);
    }

    // --------------------------------------------------------------------

    /**
     * render events as a calendar view
     *
     * @access  public
     * @param   string  $year
     * @param   string  $month
     *
     * @return  void
     **/
    public function calendar($year = NULL, $month = NULL)
    {
        $TZ = new DateTimeZone(config_item('site_timezone'));
        // assume current month, or Jan if both NULL
        if (is_null($month))
        {
            $month = is_null($year) ? date_create(NULL, $TZ)->format('n') : 1;
        }
        // assume current year
        $year = $year ?: date_create(NULL, $TZ)->format('Y');

        // get (published) events for specified month
        $month = date_create($year . '-' . $month . '-1', $TZ);
        $events = Event::month($month, cannot('manage', 'event'));

        // setup array of day-events
        $days = array();
        foreach ($events as $e)
        {
            $days[$e->local_datetime('start','j')][] = $e;
        }

        // init calendar
        $this->load->library('calendar');
        $cal_data = array();
        foreach ($days as $day => $events)
        {
            $cal_data[$day] = $this->load->view('events/calendar_day', array('events'=>$events), TRUE);
        }
        $data = array(
            'cal_data'  => $cal_data,
            'date'      => $month
        );
        $this->template
            ->title($month->format('F, Y'), 'Events', config_item('site_title'))
            ->build('events/calendar', $data);
    }

    // --------------------------------------------------------------------

}
/* End of file events.php */
/* Location: ./application/controllers/events.php */
