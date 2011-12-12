<?php
use_stylesheets_for_form($form);
use_javascripts_for_form($form);

$currModel = $form->getObject();
$action = ($currModel->isNew()) ? url_for(sfConfig::get('action_create')) : url_for(sfConfig::get('action_update'),array('id'=>$currModel->getId()));
echo $form->renderFormTag($action,array('method' => 'post','class' => 'frm clearfix','id' => 'formValidationGeneral'));
$ignores = array('id','tags_list','ativo','destaque');
?>
    <?php if (!$currModel->isNew()): ?>
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
        elseif($form[$k]->getWidget()->getOption('type')=='checkbox')
        {
            echo '<div class="clearfix"><div class="input"><ul class="inputs-list"><li>';
            echo "<label>{$form[$k]->render()}<span>{$form[$k]->renderLabelName()}</span></label>";
            echo '</li></ul></div></div>';
        }
    endforeach;
    ?>
    
    <div class="clearfix">
        <div class="hidden" id="tagit_full_list"><?php echo Tags::lista(); ?></div>
        <div class="hidden" id="tagit_model_list"><?php echo Tags::modelo(sfConfig::get('table_model'),$currModel->getId()); ?></div>
        <?php echo $form['tags_list']->renderLabel(); ?>
        <div class="input">
            <ul id="form_tags_list" data-name="<?php echo $form['tags_list']->renderName() ?>"></ul>
        </div>
    </div>
    
    <?php if(!$currModel->isNew()): ?>
        <hr/>
        <div class="clearfix">
            <h2>Upload de imagens</h2>
            <div id="uploader-container"
            data-plupload-target-url="<?php echo url_for('upload',array(),array('absolute'=>true)) ?>"
            data-plupload-swf-url="<?php echo javascript_path('vendor/plupload/plupload.flash.swf',array('absolute'=>true)) ?>"
            data-plupload-estate="<?php echo $form['id']->getValue(); ?>"
            data-plupload-rnd="<?php echo mt_rand(); ?>"
            data-add-url="<?php echo url_for('upload_add',array(),array('absolute'=>true)) ?>"
            ><p>Seu navegador não tem suporte para HTML5, Flash.</p></div>
        </div>
        <h2>Imagens <small>Faça o upload e selecione uma como destaque(a imagem em destaque ficará com a borda azul)</small></h2>
        <div id="imageFields" class="clearfix">
            <?php if ($currModel->Images->count()>0): ?>
                <?php foreach ($currModel->Images as $image): ?>
                    <?php include_partial('global/file',array('id' => $image->id,'file'=>$image->square->file,'destaque'=>$image->destaque)); ?>
                <?php endforeach ?>
            <?php endif ?>
        </div>
    <?php endif; ?>
    
    <div class="actions">
        <?php echo tag('input', array('id'=>'enviarEditar','type' => 'button', 'class' => 'btn primary', 'value' => 'Enviar e Editar')) ?>
        <?php echo tag('input', array('type' => 'submit', 'class' => 'btn primary', 'value' => 'Enviar')) ?>
        <?php echo tag('input',array('type'=>'button','class'=>'btn','value'=>'Voltar','onclick'=>'history.back();')); ?>
        <?php if (!$currModel->isNew()): ?>
            <?php echo content_tag('button', 'Remover', array('data-list'=>url_for(sfConfig::get('redirect_index')),'data-url'=>url_for(sfConfig::get('action_delete'),array('id' => $currModel->getId())),'type' => 'button', 'class' => 'btn danger deletar')) ?>
        <?php endif; ?>
    </div>
</form>
