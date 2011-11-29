<article id="event-<?php echo $event->id; ?>" class="event preview">
    <header>
        <h1><?php echo anchor(event_url($event), $event->title); ?></h1>
        <h2><?php echo $event->local_datetime('start'); ?>&ndash;<?php echo $event->local_datetime('end'); ?></h2> 
    </header>
    <div class="event-content">
        <?php echo html_word_limiter($event->content, 20); ?>
    </div>
    <footer>
        <p>Published: <time pubdate="pubdate" datetime="<?php echo $event->local_datetime('published_at','Y-m-d'); ?>"><?php echo $event->local_datetime('published_at'); ?></time></p>
    </footer>
</article>
