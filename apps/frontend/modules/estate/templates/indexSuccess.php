<div class="container">
    <div class="clearfix">
        <div id="accordionFormResult">
            <h2 class="btn orange">Comprar ou Alugar</h2>
            <div class="content">
                <div><?php include_component('estate', 'Filter'); ?></div>
            </div>
            <h2 class="btn orange">Referência</h2>
            <div class="content">
                <div><?php include_component('estate', 'Referencia'); ?></div>
            </div>
        </div>
    </div>
    
    <div class="clearfix">
        <div class="grid_3 searchResultado">
            <p>Total de imóveis encontrado: <?php echo $pager->count(); ?></p>
        </div>
        <div class="grid_3 sortingResultado">
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
