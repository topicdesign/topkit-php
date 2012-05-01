<?php

/**
 * Roles
 **/

$config['roles']['root'] = array(
    'all' => array(
        'admin' => TRUE
    ),
);

$config['roles']['admin'] = array(
    'page'       => array(
        'admin' => TRUE
    ),
    'redirect'   => array(
        'admin' => TRUE
    ),
    'user'       => array(
        'manage' => TRUE
    ),
    'role'       => array(
        'manage' => TRUE
    ),
    'permission' => array(
        'manage' => TRUE
    ),
);
