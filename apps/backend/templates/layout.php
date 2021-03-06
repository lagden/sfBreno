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
</head>
<body>
    
    <div class="hidden" id="publicPath" data-url="<?php echo public_path('/') ?>"></div>
    
    <!-- Notice -->
    <?php include_partial('global/flash_notice'); ?>
    
    <?php include_partial('global/header'); ?>
    <div class="container">
        <?php echo $sf_content ?>
        <?php include_partial('global/footer'); ?>
    </div>
    
    <?php include_javascripts() ?>
    
    <script>
        jQuery.noConflict();
    </script>
</body>
</html>
