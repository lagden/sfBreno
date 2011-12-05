<?php $menu = sfYaml::load(sfConfig::get('sf_app_config_dir'). DIRECTORY_SEPARATOR ."menu.yml"); ?>
<div id="topbarBackend" class="topbar" data-dropdown="dropdown">
    <div class="topbar-inner">
        <div class="container">
            <h3><?php echo link_to("Breno Homara Imóveis",'homepage'); ?></h3>
            <?php if ($sf_user->isAuthenticated()): ?>
                <?php echo Menu::dropdown($menu['menu'],$_SERVER['REQUEST_URI']) ?>
                <ul class="nav secondary-nav">
                    <li><a href="<?php echo url_for('auth_logout') ?>">Sair</a></li>
                </ul>
            <?php endif ?>
        </div>
    </div>
</div>
