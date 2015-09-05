<?php $lista = Lista::svgLista(); ?>
<ul class="<?php echo $ulCss ?>">
	<?php foreach ($lista as $item): ?>
		<?php if ($estate->$item['field']): ?>
			<li>
				<span><?php echo $estate->$item['field'] ?><?php echo $item['sufix'] ?></span>
				<svg class="<?php echo $svgCss ?>">
					<use xlink:href="<?php echo $item['svg'] ?>"></use>
				</svg>
				<small class="<?php echo $smallCss ?>"><?php echo $item['title'] ?></small>
			</li>
		<?php endif ?>
	<?php endforeach ?>
</ul>
