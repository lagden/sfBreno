<?php
use_stylesheets_for_form($form);
use_javascripts_for_form($form);

$action = url_for('auth_login');
echo $form->renderFormTag($action,array('method' => 'post','class' => 'frm clearfix','id' => 'formValidationLogin','data-url'=>$action));
$ignores = array();
?>
    <?php echo $form->renderHiddenFields(); ?>
    <?php echo $form->renderGlobalErrors(); ?>
    <?php
    foreach($form as $k=>$v):
        if(!in_array($k,$ignores))
        {
            $resultClass[$k]=($form[$k]->hasError())?'clearfix error':'clearfix';
            echo '<div class="'.$resultClass[$k].'">';
            echo $form[$k]->renderLabel();
            echo '<div class="input">';
            echo $form[$k]->render();
            echo '<span class="help-inline">'.$form[$k]->getError().'</span>';
            echo '</div>';
            echo '</div>';
        }
    endforeach;
    ?>
    <div class="actions">
        <?php echo tag('input', array('type' => 'submit', 'class' => 'btn primary', 'value' => 'Enviar')) ?>
    </div>
</form>
