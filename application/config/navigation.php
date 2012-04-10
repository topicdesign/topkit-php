<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| Navigation Config
| -------------------------------------------------------------------------
*/

$config['nav_template'] = array(
    'open_tag' => '<nav>',
    'close_tag' => '</nav>',
    'open_list' => '<ul>',
    'close_list' => '</ul>',
    'open_list_item' => '<li>',
    'close_list_item' => '</li>',
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
