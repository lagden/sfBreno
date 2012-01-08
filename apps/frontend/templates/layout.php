<!DOCTYPE html>

<!--[if IEMobile 7 ]><html class="no-js iem7"><![endif]-->
<!--[if lt IE 7 ]><html class="no-js ie6" lang="en"><![endif]-->
<!--[if (IE 7)&!(IEMobile) ]><html class="no-js ie7" lang="en"><![endif]-->
<!--[if (IE 8)&!(IEMobile) ]><html class="no-js ie8" lang="en"><![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)|!(IE)]><!--><html class="no-js" lang="en" itemscope itemtype="http://schema.org/Product"><!--<![endif]-->

<head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <?php include_stylesheets() ?>
    <!--[if lt IE 9]>
        <?php echo stylesheet_tag('ie.css'); ?>
    <![endif]-->
    
    <!-- Google Plus -->
    <meta itemprop="name" content="Compre ou alugue um imóvel">
    <meta itemprop="description" content="Busca de imóveis em Higienópolis para comprar ou alugar.">
    
</head>
<body>
    <?php include_partial('global/header'); ?>
    <?php echo $sf_content ?>
    <?php include_partial('global/footer'); ?>
    
    <?php include_javascripts() ?>
    
    <!--[if (lt IE 9) & (!IEMobile)]>
    <?php echo javascript_include_tag('vendor/libs/ie.js'); ?>
    <?php echo javascript_include_tag('vendor/libs/modernizr.js'); ?>
    <?php echo javascript_include_tag('vendor/libs/respond.src.js'); ?>
    <![endif]-->
    
    <!--[if lt IE 7 ]>
        <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.2/CFInstall.min.js"></script>
        <script>window.attachEvent("onload",function(){CFInstall.check({mode:"overlay"})})</script>
    <![endif]-->
    
    <script>
        jQuery.noConflict();
        
        // Google Analytics
        var _gaq=[['_setAccount','UA-22331976-1'],['_trackPageview']];
        (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];g.async=1;
        g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
        s.parentNode.insertBefore(g,s)}(document,'script'));
        
    </script>
    
    <!-- Twitter -->
    <?php echo javascript_include_tag('vendor/twitter/widgets.js'); ?>
</body>
</html>