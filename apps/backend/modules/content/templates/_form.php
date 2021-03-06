<?php
use_stylesheets_for_form($form);
use_javascripts_for_form($form);

include_partial('global/tiny_mce');

$action = ($form->getObject()->isNew()) ? url_for(sfConfig::get('action_create')) : url_for(sfConfig::get('action_update'),array('id'=>$form->getObject()->getId()));
echo $form->renderFormTag($action,array('method' => 'post','class' => 'frm clearfix','id' => 'formValidationGeneral'));
$ignores = array('id','tags_list','is_active');
?>
    <?php if (!$form->getObject()->isNew()): ?>
        <input type="hidden" name="sf_method" value="put" />
    <?php else: ?>
        <?php array_push($ignores,'change') ?>
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
    
    <div class="clearfix">
        <div class="input">
            <ul class="inputs-list">
                <li>
                    <label>
                        <?php echo $form['is_active']->render(); ?>
                        <span><?php echo $form['is_active']->renderLabelName(); ?></span>
                    </label>
                </li>
            </ul>
        </div>
    </div>
    
    <div class="clearfix">
        <div class="hidden" id="tagit_full_list"><?php echo Tags::lista(); ?></div>
        <div class="hidden" id="tagit_model_list"><?php echo Tags::modelo(sfConfig::get('table_model'),$form->getObject()->getId()); ?></div>
        <?php echo $form['tags_list']->renderLabel(); ?>
        <div class="input">
            <ul id="form_tags_list" data-name="<?php echo $form['tags_list']->renderName() ?>"></ul>
        </div>
    </div>
    
    <div class="actions">
        <?php echo tag('input', array('type' => 'submit', 'class' => 'btn primary', 'value' => 'Enviar')) ?>
        <?php echo tag('input',array('type'=>'button','class'=>'btn','value'=>'Voltar','onclick'=>'history.back();')); ?>
        <?php if (!$form->getObject()->isNew()): ?>
            <?php echo content_tag('button', 'Remover', array('data-list'=>url_for(sfConfig::get('redirect_index')),'data-url'=>url_for(sfConfig::get('action_delete'),array('id' => $form->getObject()->getId())),'type' => 'button', 'class' => 'btn danger deletar')) ?>
        <?php endif; ?>
    </div>
</form>
