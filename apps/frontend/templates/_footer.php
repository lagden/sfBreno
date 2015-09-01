<?php $info = sfConfig::get('app_footer'); ?>
<footer class="bloco bloco--footer">
	<div class="gs">
		<div class="half half--left">
			<?php $year = date('Y') ?>
			<p><?php echo link_to("© $year {$info['site']}",'homepage'); ?></p>
			<p><?php echo $info['endereco']; ?><br><?php echo $info['telefone']; ?></p>
		</div>
		<div class="half half--right">
			<p>Feito por <?php echo link_to($info['dev'],$info['devsite']); ?></p>
		</div>
	</div>
	<div class="bloco__both">
		<a href="https://www.facebook.com/pages/Breno-Homara-Im%C3%B3veis/397180946994081?fref=ts" target="_blank"><svg class="icon--small-white"><use xlink:href="#material_facebook"></use></svg></a>
		<a href="https://twitter.com/brenohomara" target="_blank"><svg class="icon--small-white"><use xlink:href="#material_twitter"></use></svg></a>
	</div>
</div>
</footer>

