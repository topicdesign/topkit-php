<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| CONTACT LANGUAGE
| -------------------------------------------------------------------
*/

/**
 * page title to use if not using database driven page content
 **/
$lang['contact-page-title'] = 'Contact';

/**
 * Subject line for emails from contact form
 **/
$lang['contact-email-subject'] = sprintf('Message from %s', config_item('site_title'));

/**
 * Status message when successful send
 **/
$lang['contact-status-success'] = 'Thank you, your message has been sent.';

/*
| -------------------------------------------------------------------
| CONTACT FORM FIELDS
| -------------------------------------------------------------------
*/
$lang['contact-field-subject'] = 'Subject';
$lang['contact-field-name']    = 'Your Name';
$lang['contact-field-email']   = 'Email Address';
$lang['contact-field-body']    = 'Message';

$lang['contact-field-submit']  = 'Send';

/*
| -------------------------------------------------------------------
| CONTACT SUBJECTS
| -------------------------------------------------------------------
| Each $config['subjects'][$key] entry should have a matching language
| entry in the form:
|
|   $lang['contact-subject-$key']
|
*/

$lang['contact-subject-general'] = 'General';
// $lang['contact-subject-other']   = 'Other';

// ------------------------------------------------------------------------

/* End of file contact_lang.php */
/* Location: ./applications/language/english/contact_lang.php */
