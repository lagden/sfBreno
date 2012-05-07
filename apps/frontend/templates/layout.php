<!DOCTYPE html>

<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="pt-br" itemscope itemtype="http://schema.org/Product" xmlns:fb="http://ogp.me/ns/fb#"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="pt-br" itemscope itemtype="http://schema.org/Product" xmlns:fb="http://ogp.me/ns/fb#"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="pt-br" itemscope itemtype="http://schema.org/Product" xmlns:fb="http://ogp.me/ns/fb#"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="pt-br" itemscope itemtype="http://schema.org/Product" xmlns:fb="http://ogp.me/ns/fb#"> <!--<![endif]-->

<head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    
    <!-- Google Plus -->
    <meta itemprop="name" content="Compre ou alugue um imóvel">
    <meta itemprop="description" content="Busca de imóveis em Higienópolis para comprar ou alugar.">
    
    <?php include_title() ?>
    <?php include_stylesheets() ?>
    
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo public_path('/favicon.ico') ?>">
    
    <!--[if (lt IE 9) & (!IEMobile)]>
    <?php echo javascript_include_tag('vendor/libs/modernizr.js'); ?>
    <![endif]-->
    
</head>
<body>
    <!-- Prompt IE 6 users to install Chrome Frame. Remove this if you support IE 6. chromium.org/developers/how-tos/chrome-frame-getting-started -->
    <!--[if lt IE 7]><p class=chromeframe>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->
    
    <?php include_partial('global/header'); ?>
    <?php echo $sf_content ?>
    <?php include_partial('global/footer'); ?>
    
    <?php include_javascripts() ?>
    
    <!--[if (gte IE 6)&(lte IE 8)]>
    <?php echo javascript_include_tag('vendor/libs/selectivizr.js'); ?>
    <![endif]-->
    
    <script>
        // Google Analytics
        var _gaq=[['_setAccount','UA-22331976-1'],['_trackPageview']];
        (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];g.async=1;
        g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
        s.parentNode.insertBefore(g,s)}(document,'script'));
        
        // Facebook
        (function(d, s, id){
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/pt_BR/all.js#xfbml=1";
            fjs.parentNode.insertBefore(js, fjs);
        }
        (document, 'script', 'facebook-jssdk'));
    </script>
    <script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>
</body>
</html>