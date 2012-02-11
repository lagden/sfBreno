<div class="flexslider">
    <ul class="slides">
        <?php foreach ($destaques as $destaque): ?>
            <?php $currImg = ($destaque->image_destaque) ? "/estates/{$destaque->image_destaque->large->file}" : false; ?>
            <?php // $currImg = ($destaque->image_destaque) ? "/estates/{$destaque->image_destaque->banner->file}" : false; ?>
            <?php $qs=array('slug'=>$destaque->slug); ?>
            <?php if ($currImg): ?>
                <li>
                    <figure>
                        <?php echo link_to(image_tag("{$currImg}",array('alt'=>$destaque->titulo)),'estate_show',$qs); ?>
                        <?php if ($destaque->destaque_chamada): ?>
                            <figcaption class="flex-caption">
                                <p><?php echo link_to("{$destaque->destaque_chamada}",'estate_show',$qs); ?></p>
                            </figcaption>
                        <?php endif ?>
                    </figure>
                </li>
            <?php endif ?>
        <?php endforeach ?>
    </ul>
</div>
