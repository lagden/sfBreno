<?php
use_stylesheets_for_form($form);
use_javascripts_for_form($form);
?>
<?php
$action = ($form->getObject()->isNew()) ? url_for(sfConfig::get('action_create')) : url_for(sfConfig::get('action_update'),array('id'=>$form->getObject()->getId()));
echo $form->renderFormTag($action,array('method' => 'post','class' => 'frm clearfix','id' => 'formValidationGeneral'));
$ignores = array('id','change');
?>
    <?php if (!$form->getObject()->isNew()): ?>
        <input type="hidden" name="sf_method" value="put" />
    <?php endif; ?>
    
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
    
    <?php if (!$form->getObject()->isNew()): ?>
        <div class="clearfix">
            <div class="input">
                <ul class="inputs-list">
                    <li>
                        <label>
                            <?php echo $form['change']->render(); ?>
                            <span><?php echo $form['change']->renderLabelName(); ?></span>
                        </label>
                    </li>
                </ul>
            </div>
        </div>
    <?php endif; ?>
    
    <div class="actions">
        <?php echo tag('input', array('type' => 'submit', 'class' => 'btn primary', 'value' => 'Enviar')) ?>
        <?php echo tag('input',array('type'=>'button','class'=>'btn','value'=>'Voltar','onclick'=>'history.back();')); ?>
        <?php if (!$form->getObject()->isNew()): ?>
            <?php echo content_tag('button', 'Remover', array('data-list'=>url_for(sfConfig::get('redirect_index')),'data-url'=>url_for(sfConfig::get('action_delete'),array('id' => $form->getObject()->getId())),'type' => 'button', 'class' => 'btn danger deletar')) ?>
        <?php endif; ?>
    </div>
</form>
