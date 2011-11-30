<?php
use_stylesheets_for_form($form);
use_javascripts_for_form($form);

use_javascript('cms/form.js');
use_javascript('cms/module/user.js');
?>

<div class="boxes">
  <div class="title">
    <span class="ui-state-default"><span class="ui-button-icon-primary ui-icon ui-icon-pencil"></span></span>
    <h3><?php echo sfConfig::get('section') ?></h3>
    <span class="ui-state-default"><span class="ui-button-icon-primary ui-icon ui-icon-plusthick"></span></span>
  </div>
  <div class="box filtrobusca drop-shadow raised">
    <div class="fixpadding">
      <?php
      $action = ($form->getObject()->isNew()) ? url_for(sfConfig::get('action_create')) : url_for(sfConfig::get('action_update'),array('id'=>$form->getObject()->getId()));
      echo $form->renderFormTag(
        $action,
        array(
          'method' => 'post',
          'class' => 'frm',
          'id' => sfConfig::get("form_id")
        )
      );
      ?>
      
      <?php if (!$form->getObject()->isNew()): ?>
        <input type="hidden" name="sf_method" value="put" />
      <?php endif; ?>
      
      <?php if($form->hasErrors() || $form->hasGlobalErrors()): ?>
      <div class="ui-widget sp_marginTB">
        <div class="ui-state-error ui-corner-all sp_paddingTB sp_paddingRL">
          <?php foreach($form as $k=>$v): ?>
            <?php if($form[$k]->hasError()): ?>
              <p>
                <span class="ui-icon ui-icon-alert sp_floatleft"></span>
                <b class="sp_paddingLeft"><?php echo $form[$k]->renderLabelName() ?></b>: <?php echo $form[$k]->getError() ?>
              </p>
            <?php endif; ?>
          <?php endforeach; ?>
        </div>
      </div>
      <?php endif; ?>
      
      <?php echo $form->renderGlobalErrors(); ?>
      <?php echo $form->renderHiddenFields(); ?>
      
      <p>
        <?php echo $form['email']->renderLabel('Email', array('class' => 'big b')); ?>
        <?php echo $form['email']->render(array('title' => 'Email', 'class' => 'required validate-email mid')); ?>
      </p>
      
      <p>
        <?php echo $form['first_name']->renderLabel('Nome', array('class' => 'big b')); ?>
        <?php echo $form['first_name']->render(array('title' => 'Nome', 'class' => 'required mid')); ?>
      </p>
      
      <p>
        <?php echo $form['last_name']->renderLabel('Sobrenome', array('class' => 'big b')); ?>
        <?php echo $form['last_name']->render(array('title' => 'Sobrenome', 'class' => 'required mid')); ?>
      </p>
      
      <p>
        <?php echo $form['permission']->renderLabel('Permissão', array('class' => 'big b')); ?>
        <?php echo $form['permission']->render(array('title' => 'Permissão')); ?>
      </p>
      
      <p>
        <?php echo $form['charge_id']->renderLabel('Cargo', array('class' => 'big b')); ?>
        <?php echo $form['charge_id']->render(array('title' => 'Cargo')); ?>
      </p>
      
      <p>
        <?php echo $form['department_id']->renderLabel('Departamento', array('class' => 'big b')); ?>
        <?php echo $form['department_id']->render(array('title' => 'Departamento')); ?>
      </p>
      
      <div class="sp_paddingBottom">
        <?php echo $form['teams_list']->renderLabel('Grupo', array('class' => 'big sp_top b')); ?>
        <?php echo $form['teams_list']->render(array('title' => 'Grupo', 'class' => '')); ?>
      </div>
      
      <?php if (!$form->getObject()->isNew()): ?>
      <p>
        <?php echo $form['change']->renderLabel('Alterar senha?', array('class' => 'big b')); ?>
        <?php echo $form['change']->render(array('class'=>'changePassword')); ?>
      </p>
      
      <p class="passwordBlock sp_none">
        <?php echo $form['password']->renderLabel('Senha', array('class' => 'big b')); ?>
        <?php echo $form['password']->render(array('title' => 'Senha','class' => 'required changePasswordField', 'disabled'=>'disabled', 'id' => 'password')); ?>
      </p>
      
      <p class="passwordBlock sp_none">
        <?php echo $form['password_again']->renderLabel('Confirme', array('class' => 'big b')); ?>
        <?php echo $form['password_again']->render(array('title' => 'Confirme','class' => "required changePasswordField validate-match matchInput:'password' matchName:'SENHA'", 'disabled'=>'disabled')); ?>
      </p>
      
      <?php else: ?>
        <p>
          <?php echo $form['password']->renderLabel('Senha', array('class' => 'big b')); ?>
          <?php echo $form['password']->render(array('title' => 'Senha','class' => 'required', 'id' => 'password')); ?>
        </p>
        
        <p>
          <?php echo $form['password_again']->renderLabel('Confirme', array('class' => 'big b')); ?>
          <?php echo $form['password_again']->render(array('title' => 'Confirme','class' => "required validate-match matchInput:'password' matchName:'SENHA'")); ?>
        </p>
      <?php endif; ?>
      
      <?php echo content_tag('button', 'Salvar', array('type' => 'submit', 'class' => 'especialOk')) ?>
      <?php echo content_tag('button', 'Voltar', array('type' => 'button', 'class' => 'voltar')) ?>
      <?php if (!$form->getObject()->isNew()): ?>
        <?php echo content_tag('button', 'Remover', array('data-list'=>url_for(sfConfig::get('redirect_index')),'data-url'=>url_for(sfConfig::get('action_delete'),array('id' => $form->getObject()->getId())),'type' => 'button', 'class' => 'deletar')) ?>
      <?php endif; ?>
      </form>
    </div>
  </div>
</div>
