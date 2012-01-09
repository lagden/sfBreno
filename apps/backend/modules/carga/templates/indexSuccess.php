<div class="content">
    <div class="page-header">
        <h1>Carga <small>Carrega os dados do sistema externo</small></h1>
    </div>
    
    <div class="row clearfix">
        <p>Clique no botão para iniciar a carga.</p>
        <p>Você receberá um e-mail avisando quando a operação estiver completa.</p>
        <?php echo content_tag('button', 'Executar carga', array('id'=>'runCarga','data-url'=>url_for('carga_run'),'type' => 'button', 'class' => 'btn danger')) ?>
    </div>
</div>
