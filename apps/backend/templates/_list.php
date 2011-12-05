<div class="row clearfix">
    <?php $lastId=$sf_user->getAttribute(sfConfig::get('last_edited')); ?>
    <?php echo content_tag('button', 'Adicionar um novo', array('data-url'=>url_for($actions['new']),'type' => 'button', 'class' => 'new btn')) ?>
    <?php if($lastId): ?>
        <?php echo content_tag('button', 'Último registro editado', array('data-url'=>url_for($actions['edit'], array('id' => $lastId)),'type' => 'button', 'class' => 'lastedit btn')) ?>
    <?php endif ?>
</div>

<div class="row clearfix">
    <div id="tableList">
        <table class="zebra-striped bordered-table" data-url="<?php echo url_for(sfConfig::get('action_sort')); ?>" data-field="<?php echo $sf_user->getAttribute(sfConfig::get('order_by'),'id'); ?>" data-direction="<?php echo $sf_user->getAttribute(sfConfig::get('order_by_direction'),'DESC'); ?>">
            <thead>
                <tr>
                    <?php foreach ($fields['labels'] as $k=>$label): ?>
                        <th data-field="<?php echo $fields['sorts'][$k]; ?>" data-pagina="<?php echo sfConfig::get('pagina',1); ?>"><?php echo $label; ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php include_partial(sfConfig::get("tbody",'global/tbody'),array('fields' => $fields,'actions' => $actions,'itens' => $itens,'lastId' => $lastId,)); ?>
            </tbody>
        </table>
    </div>
</div>
