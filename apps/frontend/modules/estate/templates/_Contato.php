<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php $contatoRota = sfConfig::get('contato_route','contato_envia') ?>
<?php echo $form->renderFormTag(url_for($contatoRota),array('method' => 'post','class' => 'frm frmFull','id'=>'frmContatoImovel','data-url'=>url_for($contatoRota))) ?>
    <?php
    $form->setDefault('ref',sfConfig::get('curr_ref'));
    echo $form['ref']->render();
    $form->setDefault('slug',sfConfig::get('curr_slug'));
    echo $form['slug']->render();
    echo $form->renderHiddenFields();
    ?>
    <ul>
        <li>
            <?php echo $form['nome']->renderLabel(); ?>
            <?php echo $form['nome']->render(array('title'=>$form['nome']->renderLabelName(),'class'=>'required')); ?>
        </li>
        <li>
            <?php echo $form['email']->renderLabel(); ?>
            <?php echo $form['email']->render(array('title'=>$form['email']->renderLabelName(),'class'=>'required')); ?>
        </li>
        <li>
            <?php echo $form['telefone']->renderLabel(); ?>
            <?php echo $form['telefone']->render(array('title'=>$form['telefone']->renderLabelName())); ?>
        </li>
        <li>
            <?php echo $form['msg']->renderLabel(); ?>
            <?php echo $form['msg']->render(array('title'=>$form['msg']->renderLabelName())); ?>
        </li>
        <li>
            <?php echo content_tag('button', 'Enviar', array('type' => 'submit', 'class' => 'btn orange button')) ?>
        </li>
    </ul>
</form>
