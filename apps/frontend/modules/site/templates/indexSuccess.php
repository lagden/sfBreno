<div class="bloco">
	<article class="gs">
		<h2 class="tt"><?php echo $title ?></h2>
		<div class="markdown-body">
			<?php echo Parsedown::instance()->text($sf_data->getRaw('c')); ?>
		</div>
	</article>
</div>
