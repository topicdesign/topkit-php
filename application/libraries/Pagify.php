<?php  

/**
 * Pagination class 
 *
 * @package		default
 * @author 		Seth Baur
 * @license		http://creativecommons.org/licenses/BSD/
 * @version		0.1
 * 
 *
 **/
class Pagify
{
    /**
     * number of object per page
     *
     * @var int
     */
    private $per_page = 5;
    
    /**
     * the total number of items
     *
     * @var int
     **/
    private $total = 0;
    
    /**
     * the current page
     *
     * @var int
     **/
    private $page = 1;
    
    /**
     * how many page numbers to show before and after
     * the current page
     *
     * @var int
     **/
    private $range = 3;
    
    /**
     * the url to link to
     *
     * @var string
     **/
    private $url = '';
    
    /**
     * show previous and next buttons
     *
     * @var bool
     **/
    private $show_prev_next = TRUE;
    
    /**
     * show first and last buttons
     *
     * @var bool
     **/
    private $show_first_last = TRUE;
    
    /**
     * show number links
     *
     * @var bool
     **/
    private $show_numbers = TRUE;
    
    /**
     * last page number
     *
     * @var int
     **/
    private $last_page_number;
    
    /**
     * Template variables
     *
     */
    private $separator = ' ';
    private $tag_open = '<div class="pagination">';
    private $tag_close = '</div>';
    private $prev_link_text = '&lt;';     
    private $prev_link_tag_open = '<span id="prev_link">';
    private $prev_link_tag_close = '</span>';
    private $next_link_text = '&gt;';     
    private $next_link_tag_open = '<span id="next_link">';
    private $next_link_tag_close = '</span>';
    private $first_link_text = 'first';
    private $first_link_tag_open = '<span id="first_link">';
    private $first_link_tag_close = '</span>';
    private $last_link_text = 'last';
    private $last_link_tag_open = '<span id="last_link">';
    private $last_link_tag_close = '</span>';
    
    // ---------------------------------------------------------------
    
    /**
     * constructor
     *
     * @access    public 
     * @param    void
     * @return    void
     **/
    public function __construct($config = array())
    {
		$this->initialize($config);
    }
    
    // ---------------------------------------------------------------
    
    /**
	 * initialize config
	 *
	 * @access	public
	 * @param	array config
	 * @return	void
	 */
	function initialize($config = array())
	{
		foreach ($config as $key => $val)
		{
		    if (method_exists($this, 'set_'.$key)) {
		        $this->{'set_'.$key}($val);
		    }
			else if (isset($this->$key))
			{
				$this->$key = $val;
			}
		}
		
		$this->last_page_number = ceil($this->total / $this->per_page);
	}
    
    // ---------------------------------------------------------------
    
    /**
     * get current links
     *
     * @access    public 
     * @param    void
     * @return    string
     **/
    public function get_links()
    {
        $output = $this->tag_open;
        $links = array();
        
        // first and previous page links, if applicable
        if ($this->page > 1) {
            if ($this->show_first_last) {
                $links[] = $this->get_first_link();
            }
            
            if ($this->show_prev_next) {
                $links[] = $this->get_prev_link();
            }
        }
        
        if ($this->show_numbers) {
            // number links before current page
            if ($this->page - $this->range > 0) {
                for ($i = $this->page - $this->range; $i < $this->page; $i++) { 
                    $links[] = '<a href="' . $this->url.$i . '">' . $i . '</a>';
                }
            }
            else {
                for ($i = 1; $i < $this->page; $i++) { 
                    $links[] = '<a href="' . $this->url.$i . '">' . $i . '</a>';
                }
            }

            // current page
            $links[] = '<strong>' . $this->page . '</strong>';

            // number links after current page
            if ($this->page + $this->range <= $this->last_page_number) {
                for ($i = $this->page + 1; $i <= $this->page + $this->range; $i++) { 
                    $links[] = '<a href="' . $this->url.$i . '">' . $i . '</a>';
                }
            }
            else {
                for ($i = $this->page + 1; $i <= $this->last_page_number; $i++) { 
                    $links[] = '<a href="' . $this->url.$i . '">' . $i . '</a>';
                }
            }
        }
        
        // show next and last page link, if applicable 
        if ($this->page < $this->last_page_number) {
            if ($this->show_prev_next) {
                $links[] = $this->get_next_link();
            }
            
            if ($this->show_first_last) {
                $links[] = $this->get_last_link();
            }
        }
        
        $output .= implode($this->separator, $links);
        $output .= $this->tag_close;
        return $output;
    }
    
    // ---------------------------------------------------------------
    
    /**
     * get current offset
     *
     * @access    public 
     * @param    void
     * @return    int
     **/
    public function get_offset()
    {
        return ($this->per_page * $this->page) - $this->per_page;
    }
    
    // ---------------------------------------------------------------
    
    /**
     * get the first page link
     *
     * @access    public 
     * @param    void
     * @return    string
     **/
    public function get_first_link()
    {
        return $this->first_link_tag_open.'<a href="'.$this->url.'1">'.$this->first_link_text.'</a>'.$this->first_link_tag_close;
    }
    
    // ---------------------------------------------------------------
    
    /**
     * get the last page link
     *
     * @access    public 
     * @param    void
     * @return    void
     **/
    public function get_last_link()
    {
        return $this->last_link_tag_open.'<a href="'.$this->url.$this->last_page_number.'">'.$this->last_link_text.'</a>'.$this->last_link_tag_close;
    }
    
    // ---------------------------------------------------------------
    
    /**
     * get the previous page link
     *
     * @access    public 
     * @param    void
     * @return    string
     **/
    public function get_prev_link()
    {
        $link = $this->prev_link_tag_open;
        if ($this->page > 1) {
            $prev_page = $this->page - 1;
            $link .= '<a href="'.$this->url.$prev_page.'">'.$this->prev_link_text.'</a>';
        }
        $link .= $this->prev_link_tag_close;
        return $link;
    }
    
    // ---------------------------------------------------------------
    
    /**
     * get the next page link
     *
     * @access    public 
     * @param    void
     * @return    void
     **/
    public function get_next_link()
    {
        $link = $this->next_link_tag_open;
        if ($this->page < $this->last_page_number) {
            $next_page = $this->page + 1;
            $link .= '<a href="'.$this->url.$next_page.'">'.$this->next_link_text.'</a>';
        }
        $link .= $this->next_link_tag_close;
        return $link;
    }
    
    // ---------------------------------------------------------------

    /**
     * output which items are showing on the page, and how many there are in total
     *
     * @access    public 
     * @param    void
     * @return    void
     **/
    public function create_showing()
    {
        $first = $this->get_offset() + 1;
        $last = $first + $this->per_page - 1;
        if ($last > $this->total) 
        {
            $last = $this->total;
        }
        return "Showing " . $first . "-" . $last . " of " . $this->total;
    }
    
    // ---------------------------------------------------------------
    
    /**
     * make sure url has a trailing /
     *
     * @access    public 
     * @param    string
     * @return    void
     **/
    public function set_url($url)
    {
        if (substr($url,-1) != '/') {
            $url .= '/';
        }
        $this->url = $url;
    }
    
    // ---------------------------------------------------------------
}

