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

/* End of file navigation.php */
/* Location: ./config/navigation.php */
