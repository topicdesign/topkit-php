<?php

// open tag
echo '<' . $template['list_item']['tag']
    . ' class="' . $template['list_item']['class'] . ' ' . get_nav_class($anchor) . '"';

foreach ($template['list_item']['attributes'] as $attr => $val) 
{
    echo $attr . '="' . $val . '"';
}
echo '>';

// anchor
if ($anchor['prepend']) echo $anchor['prepend'];
if ( ! $anchor['href']) 
{
    echo $anchor['label'];
}
else
{
    echo anchor($anchor['href'], $anchor['label'], $anchor['attr']);
}
if ($anchor['append']) echo $anchor['append'];
if ($nested && isset($anchor['children']) && ! empty($anchor['children']))
{
    $this->load->view('navigation/list', array('anchors'=>$anchor['children'], 'template'=>$template));
}

// close tag
echo '</' . $template['list_item']['tag'] . '>';
?>
