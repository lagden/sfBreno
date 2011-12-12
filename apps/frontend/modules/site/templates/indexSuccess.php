<div class="container">
    <div class="clearfix conteudoSite">
        <?php if ($contentAsSection): ?>
            <h2><?php echo link_to($c->title,'site',array('slug'=>$c->slug)) ?></h2>
        <?php else: ?>
            <h2><?php echo link_to($c->title,'site_content',array('section'=>$s->slug,'slug'=>$c->slug)) ?></h2>
        <?php endif ?>
        <hr>
        <article>
            <?php echo $c->getRawValue()->content; ?>
            <footer>
                <?php include_partial('veja',array('section'=>(($contentAsSection) ? $c : $s ))); ?>
                <?php include_partial('global/tags',array('item'=>$c)); ?>
            </footer>
        </article>
    </div>
</div>
