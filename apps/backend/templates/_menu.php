<?php $item = Menu::build($sf_user); ?>
<?php if ($item): ?>
  <nav>
    <?php echo Menu::dropdown($item,$_SERVER['REQUEST_URI']); ?>
    <div class="clear"></div>
  </nav>
<?php endif ?>
