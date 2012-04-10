<?php 
echo $template['open_list'];
foreach ($anchors as $a)
{
    if ( ! isset($a['login']) || $a['login'] == FALSE || logged_in())
        $this->load->view('navigation/li', array('anchor'=>$a, 'template'=>$template));
}
echo $template['close_list'];
?>
