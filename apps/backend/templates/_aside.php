<aside>
  <div class="separator"></div>
  <p class="sp_center"><?php echo link_to(image_tag('dock.png',array('alt'=>'Dock')),'homepage'); ?></p>
  <?php if ($sf_user->isAuthenticated()): ?>
    <div class="user">
      <h3>Olá <?php echo $sf_user->getAttribute(sfConfig::get('app_session_user_name')) ?></h3>
      <p><?php echo link_to(image_tag('/css/assets/icons/icn_door_out.png',array('alt'=>'Logout')),'auth_logout',array(),array('class'=>'tips','title'=>'','rel'=>'Sair')); ?></p>
    </div>
    <hr/>
    <nav id="menu">
      <?php echo Menu::aside(Menu::simple(),$_SERVER['REQUEST_URI']); ?>
      <?php if($sf_user->hasCredential(sfConfig::get('app_admin_credential'))): ?>
        <hr/>
        <h2>Seção Administrativa</h2>
        <?php echo Menu::aside(Menu::full(),$_SERVER['REQUEST_URI']); ?>
      <?php endif; ?>
    </nav>
  <?php endif; ?>
  <hr/>
  <small>Seepix Digital - Dock CMS © <?php echo date('Y') ?></small>
</aside>