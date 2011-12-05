<div class="content">
    <div class="page-header">
        <h1><?php echo sfConfig::get("title_list","Lista") ?></h1>
    </div>
    <div class="row clearfix">
        <?php include_component(sfConfig::get('component_class'), 'Filter'); ?>
    </div>
    <?php
    include_partial('global/list',array(
        'fields' => array(
            'labels'=>sfConfig::get('fields_labels',array()),
            'names'=>sfConfig::get('fields_names',array()),
            'sorts'=>sfConfig::get('fields_sorts',array()),
            'xtras'=>sfConfig::get('fields_xtras',array()),
        ),
        'actions' => array(
            'edit'=>sfConfig::get('action_edit'),
            'delete'=>sfConfig::get('action_delete'),
            'new'=>sfConfig::get('action_new'),
        ),
        'itens' => $pager->getResults(),
    ));
    include_partial('global/paging', array('pager' => $pager, 'route' => sfConfig::get('page_route')));
    ?>
</div>
