<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| CONTACT SETTINGS
| -------------------------------------------------------------------
| Here you can setup relationships for contact form subjects, and the
| associated email to send the submitted message to. There is also an
| associated language file which should have matching keys for all
| available subjects.
|
| The first entry in the 'subjects' array is the default.
|
*/

$config['subjects'] = array(
    'general' => config_item('site_email'),
    // 'other'   => config_item('site_email'),
);
