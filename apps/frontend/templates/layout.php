<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en" itemscope itemtype="http://schema.org/Product"> <!--<![endif]-->
<head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <?php include_stylesheets() ?>
    <!--[if lte IE 9]>
        <?php echo javascript_include_tag('vendor/libs/modernizr.js'); ?>
    <![endif]-->

    <!-- Google Plus -->
    <meta itemprop="name" content="Compre ou alugue um imóvel">
    <meta itemprop="description" content="Busca de imóveis em Higienópolis para comprar ou alugar.">
</head>
<body>
    <?php include_partial('global/header'); ?>
    <?php echo $sf_content ?>
    <?php include_partial('global/footer'); ?>
    
    <div id="fb-root" class="visuallyhidden"></div>
    
    <?php include_javascripts() ?>
    
    <!--[if lt IE 7 ]>
        <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.2/CFInstall.min.js"></script>
        <script>window.attachEvent("onload",function(){CFInstall.check({mode:"overlay"})})</script>
    <![endif]-->
    
    <!--[if lte IE 9]>
        <?php echo javascript_include_tag('vendor/libs/selectivizr.js'); ?>
    <![endif]-->
    
    <script>
        jQuery.noConflict();
        
        // Google Analytics
        var _gaq=[['_setAccount','UA-22331976-1'],['_trackPageview']];
        (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];g.async=1;
        g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
        s.parentNode.insertBefore(g,s)}(document,'script'));
        
        // Google Plus
        window.___gcfg = {lang: 'pt-BR'};

        (function() {
          var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
          po.src = 'https://apis.google.com/js/plusone.js';
          var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
        })();
        
        // Facebook
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {return;}
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=175745619119522";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
        
    </script>
    
    <!-- Twitter -->
    <script src="//platform.twitter.com/widgets.js" type="text/javascript"></script>
</body>
</html>