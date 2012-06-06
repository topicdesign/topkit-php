<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| USER MANAGED FILES
| -------------------------------------------------------------------
| This config file contains settings for managing access to end user
| uploaded files.
|
 */

// WITH trailing slash
$config['directory'] = 'assets/uploads/';

$config['uploads'] = array(
    'image' => array(
        'allowed_types' => 'gif|jpg|png',
        'max_size'      => '1024',
        'max_width'     => '1024',
        'max_height'    => '768',
    ),
    'any' => array(
        'allowed_types' => '*',
        'max_size'      => '1024',
    ),
);

/* End of file files.php */
/* Location: ./application/config/files.php */
