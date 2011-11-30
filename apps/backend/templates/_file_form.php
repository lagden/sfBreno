<?php foreach ($form[$embed] as $file):?>
<div class="sp_paddingTB sp_paddingRL sp_marginTop sp_relative boxHover <?php echo $embed ?>">
  <div
    class="ui-icon ui-icon-closethick removeBoxButton"
    data-url="<?php echo url_for(sfConfig::get('action_remove')) ?>"
    data-item="<?php echo $file['id']->getValue() ?>"
  ></div>
  <p>
    <?php echo $file['name']->renderLabel('Nome', array('class' => 'big b')); ?>
    <?php echo $file['name']->render(array('title' => 'Nome', 'class' => 'mid required')); ?>
  </p>
  
  <div>
    <?php echo $file['file']->renderLabel('Arquivo', array('class' => 'big sp_top b')); ?>
    <div class="sp_inlineblock">
      <?php echo $file['file']->render(array('title' => 'Arquivo', 'class' => '')); ?>
    </div>
  </div>
  
</div>
<?php endforeach ?>