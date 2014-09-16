<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<div class="container">
    <div class="clearfix someMargin mbottom">
        <?php $rota = url_for('venda_envia'); ?>
        <?php echo $form->renderFormTag($rota,array('method' => 'post','class'=>'frm frmFull','id'=>'frmVendaImovel','data-url'=>$rota)) ?>
        <?php echo $form->renderHiddenFields(); ?>
            <div class="grid_4 showDouble">
                <h2 class="minnulo">Venda ou alugue seu imóvel</h2>
                <h3>Informações para contato</h3>
                <hr/>
                <p>* Campo obrigatório</p>
                <ul>
                    <li>
                        <?php echo $form['nome']->renderLabel(null,array('class'=>'obr')); ?>
                        <?php echo $form['nome']->render(array('title'=>$form['nome']->renderLabelName(),'class'=>'required')); ?>
                    </li>
                    <li>
                        <?php echo $form['email']->renderLabel(null,array('class'=>'obr')); ?>
                        <?php echo $form['email']->render(array('title'=>$form['email']->renderLabelName(),'class'=>'required')); ?>
                    </li>
                    <li>
                        <?php echo $form['telefone']->renderLabel(); ?>
                        <?php echo $form['telefone']->render(array('title'=>$form['telefone']->renderLabelName())); ?>
                    </li>
                    <li>
                        <?php echo $form['disponibilidade']->renderLabel(null,array('class'=>'obr')); ?>
                        <?php echo $form['disponibilidade']->render(array('title'=>$form['disponibilidade']->renderLabelName())); ?>
                    </li>
                </ul>
            </div>
            <div class="grid_4 showDouble">
                <h2 class="minnulo">&nbsp;</h2>
                <h3>Informações do imóvel</h3>
                <hr/>
                <ul>
                    <li>
                        <?php echo $form['tipo']->renderLabel(null,array('class'=>'obr')); ?>
                        <?php echo $form['tipo']->render(array('title'=>$form['tipo']->renderLabelName())); ?>
                    </li>
                    <li>
                        <?php echo $form['bairro']->renderLabel(null,array('class'=>'obr')); ?>
                        <?php echo $form['bairro']->render(array('title'=>$form['bairro']->renderLabelName(),'class'=>'required')); ?>
                    </li>
                    <li>
                        <?php echo $form['quartos']->renderLabel(); ?>
                        <?php echo $form['quartos']->render(array('title'=>$form['quartos']->renderLabelName(),)); ?>
                    </li>
                    <li>
                        <?php echo $form['suites']->renderLabel(); ?>
                        <?php echo $form['suites']->render(array('title'=>$form['suites']->renderLabelName(),)); ?>
                    </li>
                    <li>
                        <?php echo $form['banheiros']->renderLabel(); ?>
                        <?php echo $form['banheiros']->render(array('title'=>$form['banheiros']->renderLabelName(),)); ?>
                    </li>
                    <li>
                        <?php echo $form['vagas']->renderLabel(); ?>
                        <?php echo $form['vagas']->render(array('title'=>$form['vagas']->renderLabelName(),)); ?>
                    </li>
                    <li>
                        <?php echo $form['valor']->renderLabel(null,array('class'=>'obr')); ?>
                        <?php echo $form['valor']->render(array('title'=>$form['valor']->renderLabelName(),'class'=>'required')); ?>
                    </li>
                    <li>
                        <?php echo $form['descricao']->renderLabel(null,array('class'=>'obr')); ?>
                        <?php echo $form['descricao']->render(array('title'=>$form['descricao']->renderLabelName(),'class'=>'required')); ?>
                    </li>
                    <li>
                        <?php echo content_tag('button', 'Enviar', array('type' => 'submit', 'class' => 'btn orange button')) ?>
                    </li>
                </ul>
            </div>
        </form>
    </div>
</div>
