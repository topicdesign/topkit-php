<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Contact Controller
 *
 * @package     topKit
 * @author      Topic Design
 * @license     http://creativecommons.org/licenses/BSD/
**/
class Contact extends Public_Controller
{

    // --------------------------------------------------------------------

    /**
     * Constructor
     *
     * @access  public
     * @param   void
     * @return  void
     **/
    public function __construct()
    {
        parent::__construct();
        $this->lang->load('contact');
        $this->config->load('contact', TRUE);
    }

    // --------------------------------------------------------------------

    /**
     * Default method
     *
     * NOTE: in order to support passing subjects as URI segments, you will
     * need to define a $config['route']
     *
     * @access  public
     * @param   string      $subject    Message.subject
     * @return  void
     **/
    public function index($subject = NULL)
    {
        // init page if not present
        if ( ! $page = $this->document->page)
        {
            $page = new StdClass();
            $page->title = lang('contact-page-title');
            $page->body = NULL;
        }
        $data['page'] = $page;
        // get subject options
        $subjects = $this->config->item('subjects', 'contact');
        if (count($subjects) > 1)
        {
            $data['subjects'] = array();
            foreach ($subjects as $key => $email)
            {
                $data['subjects'][$key] = lang('contact-subject-' . $key);
            }
        }
        // process the input
        $message = New Message();
        $message->name    = $this->input->post('name');
        $message->email   = $this->input->post('email');
        $message->body    = $this->input->post('body');
        $message->subject = $this->input->post('subject');
        if (empty($message->subject))
        {
            // use passed subject or default
            if ( ! is_null($subject) && isset($subjects[$subject]))
            {
                $message->subject = $subject;
            }
            else
            {
                reset($subjects);
                $message->subject = key($subjects);
            }
        }
        // validate the form
        $rules = array(
            array(
                'field'     => 'email',
                'label'     => 'lang:contact-field-email',
                'rules'     => 'trim|required|valid_email',
            ),
            array(
                'field'     => 'body',
                'label'     => 'lang:contact-field-body',
                'rules'     => 'trim|required',
            ),
        );
        $this->load->library('form_validation');
        $this->form_validation->set_rules($rules);
        $this->form_validation->set_error_delimiters('<span class="error">', '</span>');
        if( ! $this->form_validation->run() || ! $message->save())
        {
            if ($message->errors)
            {
                foreach ($message->errors->full_messages() as $e)
                {
                    set_status('error', $e);
                }
            }
            $data['message'] = $message;
            $this->document->build('contact/contact_index', $data);
        }
        else
        {
            $this->send_message($message);
            set_status('success', lang('contact-status-success'));
            $this->history->back();
        }
    }

    // --------------------------------------------------------------------

    /**
     * send Message record as email
     *
     * @access  private
     * @param   object      $message    Message Model
     * @param   string      $to         email address
     * @return  void
     **/
    private function send_message($message)
    {
        $this->load->library('email');
        $config = array(
            'crlf'      => "\r\n",
            'newline'   => "\r\n",
        );
        $this->email->initialize($config);

        $subjects = $this->config->item('subjects', 'contact');
        $this->email->to($subjects[$message->subject]);

        $this->email->from(config_item('site_email'), config_item('site_title'));
        $this->email->subject(sprintf(
            '%s: %s',
            lang('contact-email-subject'),
            lang('contact-subject-' . $message->subject)
        ));

        $data['message'] = $message;
        $this->email->message($this->document->view('contact/message_email', $data, TRUE));

        $this->email->send();
    }

    // --------------------------------------------------------------------

}
/* End of file contact.php */
/* Location: ./application/controllers/contact.php */
