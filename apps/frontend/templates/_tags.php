<?php if ($item->Tags->count()>0): ?>
    <div class="clearfix tags">
        <h3>Tags</h3>
        <hr/>
        <ul class="breadcrumb">
            <?php foreach ($item->Tags as $tag): ?>
                <li><?php echo link_to($tag->name,'tag',array('slug'=>$tag->slug)) ?></li>
            <?php endforeach ?>
        </ul>
    </div>
<?php endif ?>