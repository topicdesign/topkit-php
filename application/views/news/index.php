<section id="news-index">
    <header>
        <h1>News</h1>
    </header>
    <div class="section-content">
        <?php foreach ($articles as $a): ?>
            <pre><?php echo $a->to_json(); ?></pre>
            <hr/>
        <?php endforeach; ?>
    </div>
</section>
