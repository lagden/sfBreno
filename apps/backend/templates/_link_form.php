<div class="sp_paddingTB sp_paddingRL sp_marginTop sp_relative boxHover">
  
  <div
    class="ui-icon ui-icon-closethick removeLinkBoxButton"
    data-url="<?php echo url_for(sfConfig::get('action_remove_link')) ?>"
    data-item="<?php echo $link['id']->getValue() ?>"
  ></div>
  
  <?php echo $link['id']->render(); ?>
  
  <p>
    <?php echo $link['name']->renderLabel('Nome', array('class' => 'big b')); ?>
    <?php echo $link['name']->render(array('title' => 'Nome', 'class' => 'mid required')); ?>
  </p>
  
  <p>
    <?php echo $link['url']->renderLabel('Url', array('class' => 'big b')); ?>
    <?php echo $link['url']->render(array('title' => 'Url', 'class' => 'mid required validate-url')); ?>
  </p>
  
</div>
