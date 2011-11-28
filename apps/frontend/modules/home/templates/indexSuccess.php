<?php
use_stylesheet('jquery/flexslider.css');
use_javascript('vendor/jquery/plugins/flexslider/jquery.flexslider.js');
use_javascript('vendor/jquery/plugins/flexslider/init.js');
?>
<div class="container">
    <div class="clearfix">
        <div class="grid_2">
            <ul class="tabs" data-tabs="tabs">
                <li class="active"><a href="#compraOuAlugaTab">Pesquisar</a></li>
                <li class=""><a href="#referenciaTab">Referência</a></li>
            </ul>
            <div id="my-tab-content" class="tab-content">
                <div class="tab-pane active" id="compraOuAlugaTab">
                    <?php include_component('estate', 'Filter'); ?>
                </div>
                <div class="tab-pane" id="referenciaTab">
                    <?php include_component('estate', 'Referencia'); ?>
                </div>
            </div>
        </div>
        <div class="grid_6">
            <?php include_partial('global/slider',array('destaques'=>$destaques)); ?>
        </div>
    </div>
    <div class="clearfix listing someMargin top">
        <?php
        foreach($estates as $estate)
        {
            include_partial('global/list_estate',array('estate'=>$estate));
        }
        ?>
    </div>
    <div class="clearfix someMargin top">
        <div class="grid_4"><p>Twitter</p></div>
        <div class="grid_4"><p>Outras</p></div>
    </div>
</div>
