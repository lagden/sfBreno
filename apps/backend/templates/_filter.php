<?php use_stylesheet('cms/search.css') ?>
<?php use_javascript('cms/search.js') ?>

<div class="boxes">
    <div class="title">
        <span class="ui-state-default"><span class="ui-button-icon-primary ui-icon ui-icon-search"></span></span>
        <h3>Filtro de Busca</h3>
        <span class="ui-state-default"><span class="ui-button-icon-primary ui-icon ui-icon-plusthick"></span></span>
    </div>
    <div class="box filtrobusca drop-shadow raised">
        <div class="fixpadding">
            <?php echo $filter->renderFormTag(url_for($filterForm),array('method' => 'post','class' => 'frm'));?>
            <?php echo $filter->renderHiddenFields(); ?>
            <?php echo $filter->renderGlobalErrors(); ?>
            <?php echo $filter[$filterField]->render(); ?>
            <?php echo content_tag('button', 'Pesquisar', array('type' => 'submit', 'class' => 'pesquisar')) ?>
            <?php echo content_tag('button', 'Limpar', array('data-url'=>url_for($filterClear),'type' => 'button', 'class' => 'limpar')) ?>
        </form>
    </div>
</div>
</div>
