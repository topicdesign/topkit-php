<?php

/**
 * Roles
 **/

$config['roles'] = array(
    'admin'         => array(
        'article'   => 'manage',
        'user'      => 'manage'
    ),
    'blog_admin'    => array(
        'article'   => array(
            'create' => TRUE,
            'update' => TRUE,
        )
    ),
);
