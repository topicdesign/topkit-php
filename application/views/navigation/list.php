<?php 

// open tag
echo '<' . $template['list']['tag'] .' '
    . ' class="' . $template['list']['class'] . '"';

foreach ($template['list']['attributes'] as $attr => $val) 
{
    echo $attr . '="' . $val . '"';
}
echo '>';

foreach ($anchors as $a)
{
    if ( ! isset($a['login']) || $a['login'] == FALSE || logged_in())
        $this->load->view('navigation/list_item', array('anchor'=>$a, 'template'=>$template));
}

// close tag
echo '</' . $template['list']['tag'] . '>';
?>