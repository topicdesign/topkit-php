<?php 

// open tag
echo sprintf('<%s class="%s"', $template['list']['tag'], $template['list']['class']);

foreach ($template['list']['attributes'] as $attr => $val) 
{
    echo sprintf(' %s="%s"', $attr, $val);
}
echo '>';

foreach ($anchors as $a)
{
    if ( ! isset($a['login']) || $a['login'] == FALSE || logged_in())
        $this->load->view('navigation/list_item', array('anchor'=>$a, 'template'=>$template));
}

// close tag
echo sprintf('</%s>', $template['list']['tag']);
?>
