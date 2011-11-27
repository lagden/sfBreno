<div class="flexslider">
    <ul class="slides">
        <?php foreach ($destaques as $destaque): ?>
            <?php $qs=array('slug'=>$destaque->slug); ?>
            <li>
                <figure>
                    <?php echo link_to(image_tag('demo-stuff/inacup_samoa.jpg',array('alt'=>$destaque->titulo)),'estate_show',$qs); ?>
                    <?php if ($destaque->destaque_chamada): ?>
                        <figcaption class="flex-caption">
                            <p><?php echo link_to("{$destaque->destaque_chamada}",'estate_show',$qs); ?></p>
                        </figcaption>
                    <?php endif ?>
                </figure>
            </li>
        <?php endforeach ?>
    </ul>
</div>
