<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| IMAGE LANGUAGE
| -------------------------------------------------------------------
*/

/**
 * Used as the header on the image cropping interface
 *
 * @var string
 **/
$lang['image_cropper_title'] = 'Image Cropper';


/*
| -------------------------------------------------------------------
| IMAGE SIZE LANGUAGE
| -------------------------------------------------------------------
| Each $config['sizes'][$key][$size] entry should have a matching language
| entry in the form:
|
|   $lang['image-$key-$size-label']
|   $lang['image-$key-$size-instruction']
|
| The label and instruction will be used on the cropping interface.
|
*/

// Page language
$lang['image-page-thumb-label']         = 'Page Thumbnail';
$lang['image-page-thumb-instruction']   = 'This image will be used in the gallery view.';
$lang['image-page-preview-label']       = 'Page Preview';
$lang['image-page-preview-instruction'] = 'This image will be used on the search results list.';
$lang['image-page-full-label']          = 'Page Full Size';
$lang['image-page-full-instruction']    = 'This image will be used in the gallery view.';

// ------------------------------------------------------------------------

/* End of file image_lang.php */
/* Location: ./applications/language/english/image_lang.php */
