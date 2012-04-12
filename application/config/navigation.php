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
        'prepend' => '',
        'append'  => '',
    ),
    array(
        'href'  => '/html',
        'label' => 'Markup Test',
        'attr'  => array(
            'title' =>  "HTML Markup Test Page",
        ),
        'prepend' => '',
        'append'  => '',
    ),
);
$config['anchors']['footer'] = array(
    array(
        'href'  => '/',
        'label' => 'Home',
        'attr'  => array(
            'title' =>  "Home",
        ),
        'prepend' => '',
        'append'  => '',
    ),
    array(
        'href'  => '/html',
        'label' => 'Markup Test',
        'attr'  => array(
            'title' =>  "HTML Markup Test Page",
        ),
        'prepend' => '',
        'append'  => '',
    ),
    array(
        'href'  => '#container',
        'label' => 'Top',
        'attr'  => array(
            'title' =>  "Scroll to Top of Page",
        ),
        'prepend' => '',
        'append'  => '',
    ),
);
$config['anchors']['admin_sidebar'] = array(
    array(
        'href'  => '/admin',
        'label' => '<i class="icon-home"></i>Dashboard',
        'attr'  => array(
            'title' => 'Dashboard',
        ),
        'prepend' => '',
        'append'  => '',
    ),
    array(
        'href'  => '/admin/settings',
        'label' => 'Settings',
        'attr'  => array(
            'title' => 'Settings',
        ),
        'prepend' => '',
        'append'  => '',
        'permissions' => array(
            //'setting' => 'update',
        ),
    ),
    array(
        'href'  => '/admin/events',
        'label' => 'Events',
        'attr'  => array(
            'title' => 'Events',
        ),
        'prepend' => '',
        'append'  => '',
        'permissions' => array(
            //'event' => 'update',
        ),
    ),
    array(
        'href'  => '/admin/pages',
        'label' => '<i class="icon-file"></i>Pages',
        'attr'  => array(
            'title' => 'Pages',
        ),
        'prepend' => '',
        'append'  => '',
        'permissions' => array(
            //'page' => 'update',
        ),
    ),
    array(
        'href'  => '/admin/members',
        'label' => 'Members',
        'attr'  => array(
            'title' => 'Members',
        ),
        'prepend' => '',
        'append'  => '',
        'permissions' => array(
            //'user' => 'manage',
        ),
    ),
    array(
        'href'  => '/admin/users',
        'label' => 'Users',
        'attr'  => array(
            'title' => 'Users',
        ),
        'prepend' => '',
        'append'  => '',
        'permissions' => array(
            //'user' => 'manage',
        ),
    ),
);

/* End of file navigation.php */
/* Location: ./config/navigation.php */
