<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| IMAGE SETTINGS
| -------------------------------------------------------------------
| This config file contains settings for associating images uploaded
| by the user with other resources managed by the application. It
| allows setting crop sizes, and mamanaging the upload location. There
| is also an associated language file.
|
*/

/**
 * where to store uploaded images while cropping, WITH trailing slash
 *
 * @var string
 **/
$config['cache_dir'] = 'assets/cache/';

/**
 * where to store resized images files while cropping, WITH trailing slash
 *
 * @var string
 **/
$config['base_dir'] = 'assets/images/';

/*
| -------------------------------------------------------------------
| CROP SIZE SETTINGS
| -------------------------------------------------------------------
| The key should correspond to a resource type, typically the lowercase
| Model class name. Assets will be stored in a matching sub-folder. Each
| entry in the array corresponds to an additional output file where the
| key is appened to the file name.
|
*/

$config['sizes']['page'] = array(
    'thumb' => array(
        'width'         => 100,
        'height'        => 100,
    ),
    'preview' => array(
        'width'         => 300,
        'height'        => 150,
    ),
    'full' => array(
        'width'         => 1024,
        'height'        => 300,
    ),
);
