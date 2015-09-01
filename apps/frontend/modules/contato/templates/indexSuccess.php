<div class="bloco">
	<article class="gs">
		<h2 class="tt">Fale Conosco</h2>
		<section class="half">
			<p>Gostaria de saber mais sobre nós ou tirar alguma dúvida? Aguardamos o seu contato.</p>
      <h3><?php echo "{$info['dono']}<br>{$info['func']}" ?></h3>
      <p>
      	<?php echo "{$info['endereco']}" ?><br>
      	<?php echo "{$info['endereco2']}" ?><br>
      	<?php echo "{$info['endereco3']}" ?>
      </p>
      <p><?php echo mail_to("{$info['email']}","{$info['email']}") ?></p>
      <p>
      	<svg class="icon--small-white"><use xlink:href="#material_call"></use></svg>
      	<?php echo "{$info['telefone']}" ?><br>
      	<svg class="icon--small-white"><use xlink:href="#material_call"></use></svg>
      	<?php echo "{$info['telefone2']}" ?><br>
      </p>
		</section>
		<section class="half">
			<h3>Formulário de contato</h3>
			<?php include_component('estate', 'Contato'); ?>
		</section>
	</article>
</div>
