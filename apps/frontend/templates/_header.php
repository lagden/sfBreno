<header>
    <hgroup>
        <h1><?php echo sfConfig::get('title_site',$sf_response->getTitle()) ?></h1>
        <h2><?php echo sfConfig::get('seo_site',sfConfig::get('app_seo',"Apartamentos à venda em Higienópolis e Santa Cecília")) ?></h2>
    </hgroup>
</header>

<nav>
    <div class="wrapper">
        <?php echo link_to(image_tag('BrenoHomara.png',array('alt'=>'')),'homepage'); ?>
        <ul class="menu">
            <li><a href="/site/quem-e-breno-homara/">Quem &eacute; Breno Homara</a></li>
            <li><a href="/busca/" class="selected">Compre ou alugue um im&oacute;vel</a></li>
            <li><a href="/venda-ou-alugue/">Venda ou alugue seu im&oacute;vel</a></li>
            <li><a href="/site/administracao-de-imoveis-e-servicos/">Administra&ccedil;&atilde;o de im&oacute;veis e servi&ccedil;os</a></li>
            <li><a href="<?php echo url_for('contato'); ?>">Fale com a Breno Homara Imóveis</a></li>
        </ul>
    </div>
</nav>
