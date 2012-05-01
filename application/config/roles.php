<?php

/**
 * Roles
 **/

$config['roles'] = array(
    'root' => array(
        'all' => array(
            'manage' => TRUE
        ),
    ),
    'admin' => array(
        'page'       => array(
            'manage' => TRUE
        ),
        'redirect'   => array(
            'manage' => TRUE
        ),
        'user'       => array(
            'moderate' => TRUE
        ),
        'role'       => array(
            'manage' => TRUE
        ),
        'permission' => array(
            'manage' => TRUE
        ),
    ),
    'foo' => array(
        'page' => 'manage'
    ),
);
