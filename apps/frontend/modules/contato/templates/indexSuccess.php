<div class="container">
    <div class="clearfix someMargin mbottom">
        <div class="grid_4 showDouble">
            <h2 class="minnulo">Fale Conosco</h2>
            <h3><?php echo "{$info['site']} - {$info['creci']}" ?></h3>
            <hr/>
            <p>Envie sua mensagem, basta preencher o formulário ao lado.</p>
            <p><b><?php echo "{$info['dono']}<br>{$info['func']}" ?></b></p>
            <p><?php echo "{$info['endereco']}" ?><br><?php echo mail_to("{$info['email']}","{$info['email']}") ?></p>
            <p><?php echo "{$info['telefone']}" ?></p>
        </div>
        <div class="grid_4 showDouble">
            <h2 class="minnulo">&nbsp;</h2>
            <h3>Formulário de contato</h3>
            <hr/>
            <?php include_component('estate', 'Contato'); ?>
        </div>
    </div>
</div>
