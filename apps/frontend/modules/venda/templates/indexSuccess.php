<?php $rota = url_for('venda_envia'); ?>
<div class="bloco">
	<article class="gs">
		<h2 class="tt">Anuncie seu imóvel</h2>
		<p class="obr">Campo obrigatório</p>
		<form action="<?php echo $rota ?>" method="post" id="frmAnuncie" class="formTrigger">
			<?php echo $form->renderHiddenFields(); ?>
			<label for="contato_outrosstuff" class="vh">Outros</label>
			<input aria-hidden="true" role="presentation" type="text" name="contato[outrosstuff]" class="vh" id="contato_outrosstuff" title="Outros">
			<section class="half">
				<h3>Informações para contato</h3>
				<div class="form__input">
					<?php echo $form['nome']->renderLabel(null,array('class'=>'obr')); ?>
					<?php echo $form['nome']->render(array('title'=>$form['nome']->renderLabelName(),'class'=>'required')); ?>
				</div>
				<div class="form__input">
					<?php echo $form['email']->renderLabel(null,array('class'=>'obr')); ?>
					<?php echo $form['email']->render(array('title'=>$form['email']->renderLabelName(),'class'=>'required')); ?>
				</div>
				<div class="form__input">
					<?php echo $form['telefone']->renderLabel(); ?>
					<?php echo $form['telefone']->render(array('title'=>$form['telefone']->renderLabelName())); ?>
				</div>
				<div class="form__input">
					<?php echo $form['disponibilidade']->renderLabel(null,array('class'=>'obr')); ?>
					<?php echo $form['disponibilidade']->render(array('title'=>$form['disponibilidade']->renderLabelName())); ?>
				</div>
			</section>
			<section class="half">
				<h3>Informações do imóvel</h3>
				<div class="form__input">
					<?php echo $form['tipo']->renderLabel(null,array('class'=>'obr')); ?>
					<?php echo $form['tipo']->render(array('title'=>$form['tipo']->renderLabelName())); ?>
				</div>
				<div class="form__input">
					<?php echo $form['bairro']->renderLabel(null,array('class'=>'obr')); ?>
					<?php echo $form['bairro']->render(array('title'=>$form['bairro']->renderLabelName(),'class'=>'required')); ?>
				</div>
				<div class="form__input">
					<?php echo $form['quartos']->renderLabel(); ?>
					<?php echo $form['quartos']->render(array('title'=>$form['quartos']->renderLabelName(),)); ?>
				</div>
				<div class="form__input">
					<?php echo $form['suites']->renderLabel(); ?>
					<?php echo $form['suites']->render(array('title'=>$form['suites']->renderLabelName(),)); ?>
				</div>
				<div class="form__input">
					<?php echo $form['banheiros']->renderLabel(); ?>
					<?php echo $form['banheiros']->render(array('title'=>$form['banheiros']->renderLabelName(),)); ?>
				</div>
				<div class="form__input">
					<?php echo $form['vagas']->renderLabel(); ?>
					<?php echo $form['vagas']->render(array('title'=>$form['vagas']->renderLabelName(),)); ?>
				</div>
				<div class="form__input">
					<?php echo $form['valor']->renderLabel(null,array('class'=>'obr')); ?>
					<?php echo $form['valor']->render(array('title'=>$form['valor']->renderLabelName(),'class'=>'required')); ?>
				</div>
				<div class="form__input">
					<?php echo $form['descricao']->renderLabel(null,array('class'=>'obr')); ?>
					<?php echo $form['descricao']->render(array('title'=>$form['descricao']->renderLabelName(),'class'=>'required')); ?>
				</div>
				<div class="form__btn">
					<?php echo content_tag('button', 'Enviar', array('type' => 'submit', 'class' => 'btn orange button')) ?>
				</div>
			</section>
		</form>
	</article>
</div>
