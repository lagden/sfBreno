<?php echo $filter->renderFormTag(url_for($filterForm),array('method' => 'post','class' => 'frm'));?>
<?php echo $filter->renderHiddenFields(); ?>
<?php echo $filter->renderGlobalErrors(); ?>
    <fieldset>
        <legend>Filtro de Busca</legend>
        <div class="clearfix">
            <?php echo $filter[$filterField]->renderLabel('Palavra-chave'); ?>
            <div class="input">
                <?php echo $filter[$filterField]->render(); ?>
                <?php echo content_tag('button', 'Pesquisar', array('type' => 'submit', 'class' => 'pesquisar btn')) ?>
                <?php echo content_tag('button', 'Limpar', array('data-url'=>url_for($filterClear),'type' => 'button', 'class' => 'limpar btn')) ?>
            </div>
        </div>
    </fieldset>
<form>
