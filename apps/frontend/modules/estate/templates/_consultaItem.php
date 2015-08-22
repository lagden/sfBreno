<div class="consulta__item">
  <button class="btn-drop">
    <svg class="icon">
      <use xlink:href="<?php echo $svg ?>"></use>
    </svg>
    <span><b class="mdl-badge"><?php echo $form[$field]->renderLabel(); ?></b></span>
  </button>
  <div class="opts <?php echo $css ?>">
  	<?php echo $form[$field]->render(); ?>
  </div>
</div>
