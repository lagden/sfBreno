<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php echo $form->renderFormTag(url_for(sfConfig::get('app_route_form_filter')),array('method' => 'post','class' => 'frmBusca frm','id'=>'frmBuscaImoveis')) ?>
    <ul>
        <li>
            <?php echo $form['type_id']->renderLabel(); ?>
            <?php echo $form['type_id']->render(); ?>
        </li>
        <li>
            <?php echo $form['Disponibilidades']->renderLabel(); ?>
            <?php echo $form['Disponibilidades']->render(array('title'=>$form['Disponibilidades']->renderLabelName(),'class'=>'required','data-url'=>url_for('estate_disponibilidade'))); ?>
        </li>
        <li>
            <?php echo $form['valor']->renderLabel(); ?>
            <?php echo $form['valor']->render(); ?>
        </li>
        <li id="bairros_inline_content">
            <?php echo $form['neighborhood_id']->renderLabel(); ?>
            <?php echo content_tag('button', 'Mostrar os bairros', array('type' => 'button', 'class' => 'btn orange button showBairro', "data-href"=>"#bairros_inline")) ?>
            <div id="bairros_inline">
                <h2>Selecione os bairros</h2>
                <?php echo $form['neighborhood_id']->render(); ?>
            </div>
        </li>
        <li>
            <?php echo $form['suites']->renderLabel(); ?>
            <?php echo $form['suites']->render(); ?>
        </li>
        <li>
            <?php echo $form['quartos']->renderLabel(); ?>
            <?php echo $form['quartos']->render(); ?>
        </li>
        <li>
            <?php echo $form['banheiros']->renderLabel(); ?>
            <?php echo $form['banheiros']->render(); ?>
        </li>
        <li>
            <?php echo $form['vagas']->renderLabel(); ?>
            <?php echo $form['vagas']->render(); ?>
        </li>
        <!-- area_util
        <li>
            <?php // echo $form['area_util']->renderLabel(); ?>
            <?php // echo $form['area_util']->render(); ?>
        </li>
         -->
        <li>
            <?php echo content_tag('button', 'Encontrar', array('type' => 'submit', 'class' => 'btn orange button')) ?>
        </li>
    </ul>
</form>
