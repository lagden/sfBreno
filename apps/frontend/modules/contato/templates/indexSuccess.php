<div class="container">
    <div class="clearfix someMargin bottom">
        <div class="grid_4 showDouble">
            <h2><?php echo "{$info['site']}<br>{$info['creci']}" ?></h2>
            <hr/>
            <p>Envie sua mensagem, basta preencher o formulário ao lado.</p>
            <p><b><?php echo "{$info['dono']}<br>{$info['func']}" ?></b></p>
            <p><?php echo "{$info['endereco']}" ?><br><?php echo mail_to("{$info['email']}","{$info['email']}") ?></p>
            <p><?php echo "{$info['telefone']}" ?></p>
        </div>
        <div class="grid_4 showDouble">
            <h2>Fale<br>Conosco</h2>
            <hr/>
            <?php include_component('estate', 'Contato'); ?>
        </div>
    </div>
</div>
