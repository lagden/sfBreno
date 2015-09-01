<article class="estate-show">
	<h2><?php echo $estate->titulo ?></h2>
	<small>Código <?php echo $estate->referencia ?></small>
	<p>
		<?php echo $estate->Type->name ?> para <?php echo $estate->joinDisponibilidades ?><br>
		<?php echo "{$estate->Neighborhood->name} / {$estate->Neighborhood->City->name}" ?>
	</p>

	<h3><?php echo "Sobre o imóvel" ?></h3>
	<ul class="estateItem__icon">
		<?php foreach ($lista as $item): ?>
			<?php if ($estate->$item['field']): ?>
				<li>
					<span title="<?php echo $item['title'] ?>"><?php echo $estate->$item['field'] ?><?php echo $item['sufix'] ?></span>
					<svg class="icon--estate--show">
						<use xlink:href="<?php echo $item['svg'] ?>"></use>
					</svg>
				</li>
			<?php endif ?>
		<?php endforeach ?>
	</ul>

	<div class="markdown-body">
		<?php echo Parsedown::instance()->text($estate->getRaw('descricao')); ?>
	</div>

	<h3>Valores</h3>
	<p class="estate-show--destaque">
		<?php $complemento = ['iptu'=> 'IPTU', 'condominio'=> 'Condomínio'] ?>
		<?php foreach ($complemento as $k => $v): ?>
			R$ <?php echo number_format($estate->$k, 2, ',', '.'); ?> <?php echo "de {$v}" ?><br>
		<?php endforeach ?>
	</p>
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
</article>

<section class="estate-contato">
	<h2>Interessou?</h2>
	<?php include_component('estate', 'Contato'); ?>
</section>
