<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| Navigation Config
| -------------------------------------------------------------------------
*/

$config['nav_template']['default'] = array(
    'wrapper'   => array(
        'tag'           => 'nav',
        'class'         => '',
        'attributes'    => array(
        ),
    ),
    'list'      => array(
        'tag'           => 'ul',
        'class'         => '',
        'attributes'    => array(
        ),
    ),
    'list_item' => array(
        'tag'           => 'li',
        'class'         => '',
        'attributes'    => array(
        ),
    ),
);
$config['nav_template']['admin_sidebar'] = array(
    'wrapper'   => array(
        'tag'           => 'nav',
        'class'         => '',
        'attributes'    => array(
        ),
    ),
    'list'      => array(
        'tag'           => 'ul',
        'class'         => 'nav nav-tabs nav-stacked',
        'attributes'    => array(
            'type'  => 'toolbar',
            'id'    => 'modules',
        ),
    ),
    'list_item' => array(
        'tag'           => 'li',
        'class'         => '',
        'attributes'    => array(
        ),
    ),
);

/* EXAMPLE
$config['anchors']['main'] = array(
    array(
        'href'  => '/about',
        'label' => 'About',
        'class' => 'special',
        'attr'  => array(
            'title' => "About Us",
        ),
        'children'  => array(
            array(
                'href'  => '/about/location',
                'label' => 'Locations',
                'attr'  => array(
                    'title' => "Locations",
                ),
            ),
        )
    ),
);
 */

$config['anchors']['main'] = array(
    array(
        'href'  => '/',
        'label' => 'Home',
        'attr'  => array(
            'title' => "Home",
        ),
    ),
    array(
        'href'  => '/html',
        'label' => 'Markup Test',
        'attr'  => array(
            'title' =>  "HTML Markup Test Page",
        ),
    ),
);
$config['anchors']['footer'] = array(
    array(
        'href'  => '/',
        'label' => 'Home',
        'attr'  => array(
            'title' =>  "Home",
        ),
    ),
    array(
        'href'  => '/html',
        'label' => 'Markup Test',
        'attr'  => array(
            'title' =>  "HTML Markup Test Page",
        ),
    ),
    array(
        'href'  => '#container',
        'label' => 'Top',
        'attr'  => array(
            'title' =>  "Scroll to Top of Page",
        ),
    ),
);
$config['anchors']['admin_sidebar'] = array(
    array(
        'href'  => '/admin',
        'label' => '<i class="icon-home"></i>&nbsp;Dashboard',
        'attr'  => array(
            'title' => 'Dashboard',
        ),
        'prepend' => '',
        'append'  => '',
    ),
    array(
        'href'  => '/admin/settings',
        'label' => '<i class="icon-list-alt"></i>&nbsp;Settings',
        'attr'  => array(
            'title' => 'Settings',
            'class' => 'disabled',
        ),
        'prepend' => '',
        'append'  => '',
        'permissions' => array(
            //'setting' => 'update',
        ),
    ),
    array(
        'href'  => '/admin/pages',
        'label' => '<i class="icon-file"></i>&nbsp;Pages',
        'attr'  => array(
            'title' => 'Pages',
        ),
        'prepend' => '',
        'append'  => '',
        'permissions' => array(
            'page' => 'read',
        ),
    ),
    array(
        'href'  => '/admin/redirects',
        'label' => '<i class="icon-file"></i>&nbsp;Redirects',
        'attr'  => array(
            'title' => 'Redirects',
        ),
        'prepend' => '',
        'append'  => '',
        'permissions' => array(
            'redirect' => 'read',
        ),
    ),
    array(
        'href'  => '/admin/users',
        'label' => '<i class="icon-user"></i>&nbsp;Users',
        'attr'  => array(
            'title' => 'Users',
        ),
        'prepend' => '',
        'append'  => '',
        'permissions' => array(
            'user' => 'read',
        ),
    ),
);

/* End of file navigation.php */
/* Location: ./config/navigation.php */
