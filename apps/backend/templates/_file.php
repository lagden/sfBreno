<div class="ib_img" data-img-id="<?php echo $id ?>">
    <div class="ui-icon ui-icon-closethick removeImage"
    data-url="<?php echo url_for('upload_remove') ?>"
    data-img-id="<?php echo $id ?>"
    ></div>
    <?php $classes = ($destaque) ? array('file','destaque') : array('file'); ?>
    <?php echo image_tag("/estates/{$file}",array('class'=>join(' ',$classes),'alt'=>'','data-img-id'=>$id,'data-url'=>url_for('upload_destaque'))); ?>
</div>
