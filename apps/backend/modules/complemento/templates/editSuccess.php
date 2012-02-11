<div class="content">
    <div class="page-header">
        <h1><?php echo sfConfig::get("title_edit","Edita") ?></h1>
    </div>
    <div class="row clearfix">
        <?php include_partial('form', array('form' => $form)); ?>
    </div>
</div>
