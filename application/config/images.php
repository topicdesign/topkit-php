<?php

/**
 * Images size presets
 **/

$config['directory'] = 'assets/images/';

$config['sizes']['article_image'] = array(
    array(
        'label'         => 'Preview',
        'instructions'  => 'This image will be used in the article list.',
        'width'         => 100,
        'height'        => 100,
    ),
    array(
        'label'         => 'Full',
        'instructions'  => 'This image will be used in the actual article page.',
        'width'         => 400,
        'height'        => 300,
    ),
);
