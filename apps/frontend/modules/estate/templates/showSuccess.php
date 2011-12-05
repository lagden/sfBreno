<div class="container">
    <div class="clearfix">
        <?php include_partial('global/accordion'); ?>
    </div>
    <?php include_partial('global/back'); ?>
    <div class="clearfix someMargin mbottom">
        <?php include_partial('estate', array('estate' => $estate,'lista' => $lista)); ?>
    </div>
    <?php include_partial('global/back'); ?>
</div>
