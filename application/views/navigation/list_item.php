<?php

// open tag
echo sprintf('<%s class="%s %s"',
    $template['list_item']['tag'],
    $template['list_item']['class'],
    get_nav_class($anchor)
    );

foreach ($template['list_item']['attributes'] as $attr => $val) 
{
    echo sprintf(' %s="%s"', $attr, $val);
}
echo '>';

// anchor
if (isset($anchor['prepend'])) echo $anchor['prepend'];
if ( ! $anchor['href']) 
{
    echo $anchor['label'];
}
else
{
    echo anchor($anchor['href'], $anchor['label'], $anchor['attr']);
}
if (isset($anchor['append'])) echo $anchor['append'];
if ($nested && isset($anchor['children']) && ! empty($anchor['children']))
{
    $this->load->view('navigation/list', array('anchors'=>$anchor['children'], 'template'=>$template));
}

// close tag
echo sprintf('</%s>', $template['list_item']['tag']);
?>
