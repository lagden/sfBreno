<div class="container">
    <div class="clearfix conteudoSite">
        <h2>Tags: <?php echo $tag->name ?></h2>
        <hr>
        <article class="vejatb">
            <?php if ($sections->count()>0): ?>
                <h3>Seções</h3>
                <hr/>
                <ul>
                    <?php foreach ($sections as $section): ?>
                        <li><?php echo link_to($section->title,'site',array('slug'=>$section->slug)) ?></li>
                    <?php endforeach ?>
                </ul>
            <?php endif ?>
            <?php if ($contents->count()>0): ?>
                <h3>Conteúdo</h3>
                <hr/>
                <ul>
                    <?php foreach ($contents as $content): ?>
                        <li><?php echo link_to($content->title,'site_content',array('section'=>$content->Section->slug,'slug'=>$content->slug)) ?></li>
                    <?php endforeach ?>
                </ul>
            <?php endif ?>
            <?php if ($estates->count()>0): ?>
                <h3>Imóveis</h3>
                <hr/>
                <ul>
                    <?php foreach ($estates as $estate): ?>
                        <li><?php echo link_to($estate->titulo,'estate_show',array('slug'=>$estate->slug)) ?></li>
                    <?php endforeach ?>
                </ul>
            <?php endif ?>
        </article>
    </div>
</div>
