<div class="ib_img" data-img-id="<?php echo $id ?>">
    <div class="ui-icon ui-icon-closethick removeImage"
    data-url="<?php echo url_for('upload_remove') ?>"
    data-img-id="<?php echo $id ?>"
    ></div>
    <?php $classes = ($destaque) ? ['file','destaque'] : ['file']; ?>
    <?php echo image_tag("{$file}", [
      'class'=>join(' ', $classes),
      'alt'=>'',
      'data-img-id'=>$id,
      'data-url'=>url_for('upload_destaque'),
      'srcset'=>"{$file} 1x, {$file2x} 2x"
    ]); ?>
</div>
