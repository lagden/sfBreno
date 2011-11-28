<div class="container">
    <div class="clearfix">
        <?php include_partial('global/accordion'); ?>
    </div>
    <div class="clearfix">
        <div class="grid_4 searchResultado">
            <p>Total de imóveis encontrado: <?php echo $pager->count(); ?></p>
        </div>
        <div class="grid_4 sortingResultado">
            <p class="right"><?php include_component('estate', 'Sorting'); ?></p>
        </div>
    </div>
    <div class="clearfix listing someMargin top">
        <?php foreach($pager->getResults() as $estate) include_partial('global/list_estate',array('estate'=>$estate)); ?>
    </div>
    <div class="clearfix someMargin top">
        <?php include_partial('global/paging', array('pager' => $pager, 'route' => sfConfig::get('page_route'))); ?>
    </div>
</div>
