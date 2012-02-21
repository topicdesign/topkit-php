<section id="events-index">
    <header>
        <h1><?php echo $template['title']; ?></h1>
    </header>
    <div class="section-content">
        <?php
            if ( ! count($events)) echo sprintf('<p>%s</p>', lang('events_not_found'));
            else foreach ($events as $e) $this->load->view('events/event_preview', array('event'=>$e));
            echo $this->pagify->get_links();
        ?>
    </div>
</section>
