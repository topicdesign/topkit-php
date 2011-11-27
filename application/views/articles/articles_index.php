<section id="articles-index">
    <header>
        <h1><?php echo $template['title']; ?></h1>
    </header>
    <div class="section-content">
        <?php if ( ! count($articles)): ?>
        <p>No articles on file.</p>
        <?php else: foreach ($articles as $a) $this->load->view('articles/article_preview', array('article'=>$a)); endif; ?>
        <?php echo $this->pagify->get_links(); ?>
    </div>
</section>
