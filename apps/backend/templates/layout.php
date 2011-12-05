<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <?php include_stylesheets() ?>
    <!--[if lte IE 9]>
        <?php echo javascript_include_tag('vendor/libs/modernizr.js'); ?>
    <![endif]-->
</head>
<body>
    
    <div class="hidden" id="publicPath" data-url="<?php echo public_path('/') ?>"></div>
    
    <?php include_partial('global/header'); ?>
    <div class="container">
        <?php echo $sf_content ?>
        <?php include_partial('global/footer'); ?>
    </div>
    
    <?php include_javascripts() ?>
    
    <!--[if lt IE 7 ]>
        <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.2/CFInstall.min.js"></script>
        <script>window.attachEvent("onload",function(){CFInstall.check({mode:"overlay"})})</script>
    <![endif]-->
    
    <!--[if lte IE 8]>
        <?php echo javascript_include_tag('vendor/libs/selectivizr.js'); ?>
    <![endif]-->
    
    <script>
        jQuery.noConflict();
    </script>
</body>
</html>
