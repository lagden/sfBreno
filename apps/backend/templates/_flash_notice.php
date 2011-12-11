<!-- Notice -->
<?php if ($sf_user->hasFlash('notice')): ?>
    <div class="hidden" id="flash_notice"><?php echo $sf_user->getFlash('notice') ?></div>
<?php endif ?>