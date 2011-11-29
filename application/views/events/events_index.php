<section id="events-index">
    <header>
        <h1><?php echo $template['title']; ?></h1>
    </header>
    <div class="section-content">
        <?php if ( ! count($events)): ?>
        <p>No events on file.</p>
        <?php else: foreach ($events as $e) $this->load->view('events/event_preview', array('event'=>$e)); endif; ?>
        <?php echo $this->pagify->get_links(); ?>
    </div>
</section>
