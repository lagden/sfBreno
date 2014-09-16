<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no">

    <?php include_http_metas() ?>
    <?php include_metas() ?>

    <!-- Google Plus -->
    <meta itemprop="name" content="Compre ou alugue um imóvel">
    <meta itemprop="description" content="Busca de imóveis em Higienópolis para comprar ou alugar.">

    <?php include_title() ?>
    <?php include_stylesheets() ?>

    <link rel="shortcut icon" type="image/x-icon" href="<?php echo public_path('/favicon.ico') ?>">
</head>
<body>


    <?php include_partial('global/header'); ?>
    <?php echo $sf_content ?>
    <?php include_partial('global/footer'); ?>

    <?php include_javascripts() ?>

    <!--[if (gte IE 6)&(lte IE 8)]><?php echo javascript_include_tag('vendor/libs/selectivizr.js'); ?><![endif]-->

    <script>
        // Google Analytics
        var _gaq=[['_setAccount','UA-22331976-1'],['_trackPageview']];
        (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];g.async=1;
        g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
        s.parentNode.insertBefore(g,s)}(document,'script'));
    </script>
</body>
</html>