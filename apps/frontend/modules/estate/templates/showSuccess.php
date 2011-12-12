<div class="container">
    <div class="clearfix">
        <?php include_partial('global/accordion'); ?>
    </div>
    <?php include_partial('global/back'); ?>
    <?php if (!$estate->ativo): ?>
        <div class="clearfix alert-message error center">
            <span><strong>Atenção!</strong> Imóvel inativo. Utilize o sistema de pesquisa acima.</span>
        </div>
    <?php endif ?>
    <div class="clearfix someMargin mbottom">
        <?php include_partial('estate', array('estate' => $estate,'lista' => $lista)); ?>
    </div>
    <?php include_partial('global/back'); ?>
</div>
