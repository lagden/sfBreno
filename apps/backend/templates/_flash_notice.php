<!-- Notice -->
<?php if ($sf_user->hasFlash('notice')): ?>
  <div class="sp_none" id="flash_notice"><?php echo $sf_user->getFlash('notice') ?></div>
<?php endif ?>