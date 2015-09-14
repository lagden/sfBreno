<article class="estate-show" id="estateDetalhe" data-ativo="<?php echo ($estate->ativo) ? 1 : 0 ?>">
	<h2><?php echo $estate->titulo ?></h2>
	<small>Código <?php echo $estate->referencia ?> <?php if (!$estate->ativo): ?><span class="estate-inativo"><b>Atenção:</b> Imóvel inativo!</span><?php endif ?></small>
	<p>
		<?php echo $estate->Type->name ?> para <?php echo $estate->joinDisponibilidades ?><br>
		<?php echo "{$estate->Neighborhood->name} / {$estate->Neighborhood->City->name}" ?>
	</p>

	<h3><?php echo "Sobre o imóvel" ?></h3>
	<?php include_partial('global/quantidade', ['estate'=>$estate, 'ulCss'=>'estateItem__icon', 'svgCss'=>'icon--estate--show', 'smallCss'=>'icon--label']); ?>

	<h3>Valores</h3>
	<p class="estate-show--destaque">
	<?php foreach ($estate->Disponibilidades as $d): ?>
		<?php
		$label="";
		$value="";
		switch($d->id)
		{
			case 1:
			$label="para compra";
			$value="{$estate->ValorVenda}";
			break;

			case 2:
			$label="para locação";
			$value="{$estate->ValorAluga}";
			break;

			default:
			$label=$value=false;
		}
		?>
		<?php if ($label && $value): ?>
			R$ <?php echo $value; ?> <?php echo $label; ?><br>
		<?php endif ?>
	<?php endforeach ?>
	</p>

	<h3>Informações</h3>
	<p class="estate-show--destaque">
		<?php $complemento = ['iptu'=> 'IPTU', 'condominio'=> 'Condomínio'] ?>
		<?php foreach ($complemento as $k => $v): ?>
			R$ <?php echo number_format($estate->$k, 2, ',', '.'); ?> <?php echo "de {$v}" ?><br>
		<?php endforeach ?>
	</p>

	<div class="markdown-body">
		<?php echo Parsedown::instance()->text($estate->getRaw('descricao')); ?>
	</div>
</article>

<section class="estate-contato">
	<h2>Interessou?</h2>
	<?php include_component('estate', 'Contato'); ?>
</section>
