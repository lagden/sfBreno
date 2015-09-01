<?php include_component('estate', 'Filter'); ?>
<div class="gs pad-2015">
	<p>Total de imóveis encontrado: <?php echo $pager->count(); ?></p>
	<?php /* include_component('estate', 'Sorting'); */ ?>
</div>
<?php include_partial('global/list_estate', ['estates' => $pager->getResults()]); ?>
<div class="gs pad-2015">
	<?php include_partial('global/paging', ['pager' => $pager, 'route' => sfConfig::get('page_route')]); ?>
</div>
