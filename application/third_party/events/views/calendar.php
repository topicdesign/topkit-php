<section id="calendar">
    <header>
        <h1><?php echo $template['title']; ?></h1>
    </header>
    <div class="section-content">
        <?php echo $this->calendar->generate($date->format('Y'), $date->format('n'), $cal_data); ?>
    </div>
</section>
