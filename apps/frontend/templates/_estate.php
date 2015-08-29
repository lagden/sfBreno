<?php
$img1x = $estate->image_destaque->formato('t');
$img2x = $estate->image_destaque->formato('t2x');
$qs = ['slug'=>$estate->slug];
$img = "<img src=\"{$img1x}\" srcset=\"{$img1x} 1x, {$img2x} 2x\" class=\"estateItem__img\" alt=\"{$qs['slug']}\">";
$items = [
['svg'=>'#custom_suite', 'field'=>'suites', 'title'=>'Suítes', 'sufix'=>''],
['svg'=>'#custom_quarto', 'field'=>'quartos', 'title'=>'Quartos', 'sufix'=>''],
['svg'=>'#custom_banheiro', 'field'=>'banheiros', 'title'=>'Banheiros', 'sufix'=>''],
['svg'=>'#custom_vaga', 'field'=>'vagas', 'title'=>'Vagas para veículos', 'sufix'=>''],
['svg'=>'#custom_metro', 'field'=>'area_util', 'title'=>'Área útil', 'sufix'=>'m²'],
];
?>
<article class="estateItem">
	<?php echo $img ?>
	<div class="estateItem__info">
		<header>
			<h1><?php echo $estate->Type->name ?> para <?php echo $estate->joinDisponibilidades ?></h1>
			<h2><?php echo link_to("{$estate->titulo}",'estate_show',$qs); ?></h2>
			<small>Código <?php echo $estate->referencia ?></small>
		</header>
		<div class="estateItem__group">
			<ul class="estateItem__icon">
				<?php foreach ($items as $item): ?>
					<?php if ($estate->$item['field']): ?>
						<li>
							<span title="<?php echo $item['title'] ?>"><?php echo $estate->$item['field'] ?><?php echo $item['sufix'] ?></span>
							<svg class="icon--estate">
								<use xlink:href="<?php echo $item['svg'] ?>"></use>
							</svg>
						</li>
					<?php endif ?>
				<?php endforeach ?>
			</ul>
			<div class="estateItem__valor-detalhe">
				<?php $countDisponibilidade = $estate->Disponibilidades->count() ?>
				<?php foreach ($estate->Disponibilidades as $d): ?>
					<?php
					$label="";
					$value="";
					switch($d->id)
					{
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
