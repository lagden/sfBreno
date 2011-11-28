<?php $info = sfConfig::get('app_footer'); ?>
<footer>
    <div class="clearfix">
        <div class="fx">
            <p><?php echo link_to("{$info['site']} ({$info['creci']})",'homepage'); ?></p>
            <p><?php echo $info['endereco']; ?><br><?php echo $info['telefone']; ?></p>
            <p><a href="https://twitter.com/brenohomara" class="twitter-follow-button" data-show-count="false">Follow @brenohomara</a></p>
        </div>
        <div class="fx right">
            <?php echo link_to(image_tag('BrenoHomaraLaranja.png',array('alt'=>'')),'homepage'); ?>
            <p>Desenvolvido por <?php echo link_to($info['dev'],$info['devsite']); ?></p>
        </div>
    </div>
</footer>

