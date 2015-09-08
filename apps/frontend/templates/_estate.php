<?php
$qs = ['slug'=>$estate->slug];
$attr = [];
$svg = false;
if ($estate->image_destaque) {
	$img1x = $estate->image_destaque->formato('m');
	$img2x = $estate->image_destaque->formato('m2x');
} else {
	$svg = '<svg><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#material_local_see">Sem imagem</use></svg>';
}

if ($svg) {
	$img = $svg;
	$attr['class'] = 'has--svg';
} else {
	$img = "<img src=\"{$img1x}\" srcset=\"{$img1x} 1x, {$img2x} 2x\" class=\"estateItem__img\" alt=\"{$qs['slug']}\">";
}

?>
<article class="estateItem">
	<?php echo link_to("{$img}",'estate_show', $qs, $attr); ?>
	<div class="estateItem__info">
		<header>
			<h2>
				<?php echo $estate->Type->name ?> para <?php echo $estate->joinDisponibilidades ?><br>
				<?php echo "{$estate->Neighborhood->name} / {$estate->Neighborhood->City->name}" ?>
			</h2>
			<h1><?php echo link_to("{$estate->titulo}",'estate_show',$qs); ?></h1>
			<small>Código <?php echo $estate->referencia ?></small>
		</header>
		<div class="estateItem__group">
			<?php include_partial('global/quantidade', ['estate'=>$estate, 'ulCss'=>'estateItem__icon', 'svgCss'=>'icon--estate', 'smallCss'=>'icon--label']); ?>
			<div class="estateItem__valor-detalhe">
				<?php $countDisponibilidade = $estate->Disponibilidades->count() ?>
				<?php foreach ($estate->Disponibilidades as $d): ?>
					<?php
					$label="";
					$value="";
					switch($d->id) {
						case 1:
						$label = ($countDisponibilidade > 1) ? "Compra<br>" : "";
						$value="{$estate->ValorVenda}";
						break;

						case 2:
						$label = ($countDisponibilidade > 1) ? "Locação<br>" : "";
						$value="{$estate->ValorAluga}";
						break;

						default:
						$label=$value=false;
					}
					?>
					<?php if ($value): ?>
						<div class="estateItem__valor"><?php echo $label; ?> R$ <?php echo $value; ?></div>
					<?php endif ?>
				<?php endforeach ?>
				<?php echo link_to('Detalhes', 'estate_show', $qs, ['class'=>'estateItem__detalhe']); ?>
			</div>
		</div>
	</div>
</article>
