<?php
$contatoRota = sfConfig::get('contato_route', 'contato_envia');
$form->setDefault('ref', sfConfig::get('curr_ref'));
$form->setDefault('slug', sfConfig::get('curr_slug'));
echo $form->renderFormTag(url_for($contatoRota), ['method'=> 'post', 'id'=> 'frmContatoImovel', 'class'=> 'formTrigger']);
echo $form->renderHiddenFields();
?>

	<label for="contato_outrosstuff" class="vh">Outros</label>
	<input aria-hidden="true" role="presentation" type="text" name="contato[outrosstuff]" class="vh" id="contato_outrosstuff" title="Outros">

	<div class="form__input">
		<?php echo $form['nome']->renderLabel(); ?>
		<?php echo $form['nome']->render(array('title'=>$form['nome']->renderLabelName(),'class'=>'required')); ?>
	</div>
	<div class="form__input">
		<?php echo $form['email']->renderLabel(); ?>
		<?php echo $form['email']->render(array('title'=>$form['email']->renderLabelName(),'class'=>'required')); ?>
	</div>
	<div class="form__input">
		<?php echo $form['telefone']->renderLabel(); ?>
		<?php echo $form['telefone']->render(array('title'=>$form['telefone']->renderLabelName())); ?>
	</div>
	<div class="form__input">
		<?php echo $form['msg']->renderLabel(); ?>
		<?php echo $form['msg']->render(array('title'=>$form['msg']->renderLabelName())); ?>
	</div>
	<div class="form__btn">
		<?php echo content_tag('button', 'Enviar', array('type' => 'submit', 'class' => 'btn orange button')) ?>
	</div>
</form>
