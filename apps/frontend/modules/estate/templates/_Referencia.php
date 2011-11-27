<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php echo $form->renderFormTag(url_for('estate_referencia'),array('method' => 'post','class' => 'frmBusca frm','id'=>'frmBuscaImoveisRef','data-url'=>url_for('estate_referencia'))) ?>
    <ul>
        <li>
            <?php echo $form['referencia']->renderLabel(); ?>
            <?php echo $form['referencia']->render(array('class'=>'required','title'=>$form['referencia']->renderLabelName())); ?>
        </li>
        <li class="">
            <?php echo content_tag('button', 'Encontrar', array('type' => 'submit', 'class' => 'btn orange button')) ?>
        </li>
    </ul>
</form>
