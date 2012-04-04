<ul>
    <?php foreach ($anchors as $a)
        if ( ! isset($a['login']) || $a['login'] == FALSE || logged_in())
            $this->load->view('navigation/li', array('anchor'=>$a));
    ?>
</ul>
