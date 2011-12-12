<header>
    <hgroup>
        <h1><?php echo sfConfig::get('title_site',$sf_response->getTitle()) ?></h1>
        <h2><?php echo sfConfig::get('seo_site',sfConfig::get('app_seo',"Apartamentos à venda em Higienópolis e Santa Cecília")) ?></h2>
    </hgroup>
</header>

<nav>
    <div class="wrapper">
        <?php echo link_to(image_tag('BrenoHomara.png',array('alt'=>'')),'homepage'); ?>
        <?php include_component('home', 'Menu'); ?>
    </div>
</nav>
