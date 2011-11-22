<!-- apps/frontend/modules/job/templates/_form.php -->
<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
 
<?php // echo form_tag_for($form, 'homepage') ?>
<?php echo $form->renderFormTag(url_for('homepage'),array('method' => 'post','class' => 'frmBusca')) ?>
    <ul>
        <li>
            <?php echo $form['type_id']->renderLabel(); ?>
            <?php echo $form['type_id']->render(); ?>
        </li>
        <li>
            <?php echo $form['disponibilidade']->renderLabel(); ?>
            <?php echo $form['disponibilidade']->render(); ?>
        </li>
        <li>
            <?php echo $form['valor']->renderLabel(); ?>
            <?php echo $form['valor']->render(); ?>
        </li>
        <li>
            <?php echo $form['bairros']->renderLabel(); ?>
            <?php echo $form['bairros']->render(); ?>
        </li>
        <li>
            <?php echo $form['suite']->renderLabel(); ?>
            <?php echo $form['suite']->render(); ?>
        </li>
        <li>
            <?php echo $form['quarto']->renderLabel(); ?>
            <?php echo $form['quarto']->render(); ?>
        </li>
        <li>
            <?php echo $form['vaga']->renderLabel(); ?>
            <?php echo $form['vaga']->render(); ?>
        </li>
        <li>
            <?php echo $form['area']->renderLabel(); ?>
            <?php echo $form['area']->render(); ?>
        </li>
        <li class="">
            <?php echo content_tag('button', 'Encontrar', array('type' => 'submit', 'class' => 'btn orange button')) ?>
        </li>
    </ul>
</form>