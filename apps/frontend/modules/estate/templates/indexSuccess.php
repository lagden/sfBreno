<?php $total = $pager->count(); ?>
<?php include_component('estate', 'Filter'); ?>
<div class="gs pad-2015">
	<p>Total de imóveis encontrado: <?php echo $total ?></p>
	<?php /* include_component('estate', 'Sorting'); */ ?>
</div>
<?php if ($total): ?>
	<?php include_partial('global/list_estate', ['estates' => $pager->getResults()]); ?>
	<div class="gs pad-2015">
		<?php include_partial('global/paging', ['pager' => $pager, 'route' => sfConfig::get('page_route')]); ?>
	</div>
<?php endif ?>
