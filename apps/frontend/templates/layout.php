<!DOCTYPE html>
<html lang="pt-br">
<head>
		<?php
		// Cache version
		// $cacheVersion = '.' . implode('', explode('.',sfConfig::get('app_cache_version')));
		$cacheVersion = '.' . '2.0.8';
		$neverCacheVersion = mt_rand();
		?>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="description" content="Breno Homara Imóveis é uma imobiliária localizada no bairro de Higienópolis que fica na região central de São Paulo. Temos diversos imóveis para venda. Apartamentos de 01, 02, 03, 04 ou mais dormitórios. Apartamentos com súites. Oferta de Imóveis em edifícios que possuem área de lazer. Apartamentos à venda em Higienópolis e Santa Cecília que possuem sacada e ou terraço.">
		<meta name="keywords" content="apartamento, higienópolis, higienopolis, apartamentos em higienópolis, Breno, Homara, Imóveis, imóvel em higienopolis, venda imóveis, vende-se imóvel, imoveis, casa, apartamento, prédio, cobertura, mansão, alto padrão, fotos, pacaembu, santa cecilia, santa cecília, compra, venda, aluguel, locação, negociação, perdizes, são paulo, sao paulo, imóveis em são paulo, locação higienopolis, venda higienópolis, apartamento em higienópolis, apartamento em sao paulo, apartamento em são paulo, classificados, classificados de imóveis, imóveis, imovel, imoveis, casa, apartamento">
		<meta name="google-site-verification" content="ku7lXLQ8RXmHBPV9uR1ieE-CmIca_cuy2VDPEGAziFs">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title><?php echo sfConfig::get('title', Helper::getTitle()) ?></title>

		<?php /* <!-- Add to homescreen --> */ ?>
		<?php /* <link rel="manifest" href="<?php echo public_path("/manifest{$cacheVersion}.json") ?>"> */ ?>

		<?php /* <!-- Add to homescreen for Safari on iOS --> */ ?>
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta name="apple-mobile-web-app-title" content="<?php echo  sfConfig::get('app_name', 'Nimble'); ?>">
		<link rel="apple-touch-icon-precomposed" href="<?php echo public_path("/images/touch/apple-touch-icon-precomposed{$cacheVersion}.png") ?>">

		<?php /* <!-- Tile icon for Win8 (144x144 + tile color) --> */ ?>
		<meta name="msapplication-TileImage" content="<?php echo public_path("/images/touch/ms-touch-icon-144x144-precomposed{$cacheVersion}.png") ?>">
		<meta name="msapplication-TileColor" content="#3372DF">

		<meta name="theme-color" content="#3372DF">

		<!-- Google Plus -->
		<meta itemprop="name" content="Compre ou alugue um imóvel">
		<meta itemprop="description" content="Busca de imóveis em Higienópolis para comprar ou alugar.">

		<!--[if IE]><link rel="shortcut icon" href="<?php echo public_path("/favicon{$cacheVersion}.ico") ?>"><![endif]-->
		<link rel="icon" href="<?php echo public_path("/favicon{$cacheVersion}.png") ?>">
		<?php
			$nouislider = sfConfig::get("sf_web_dir") . "/js2/lib/nouislider/distribute/nouislider.min.css";
			$flickity = sfConfig::get("sf_web_dir") . "/js2/lib/flickity/dist/flickity.min.css";
			// $markdown = sfConfig::get("sf_web_dir") . "/css2/github-markdown.css";
			$critical = sfConfig::get("sf_web_dir") . "/css2/critical.css";
		?>
		<style>
			<?php echo file_get_contents($nouislider); ?>
			<?php echo file_get_contents($flickity); ?>
			<?php echo file_get_contents($critical); ?>
		</style>

		<script type="text/javascript">
			'use strict';
			var _gaq = _gaq || [];
			_gaq.push(['_setAccount', 'UA-22331976-1']);
			_gaq.push(['_trackPageview']);

			(function() {
				var ga = document.createElement('script');
				ga.type = 'text/javascript';
				ga.async = true;
				ga.src = (document.location.protocol === 'https:' ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
				var s = document.getElementsByTagName('script')[0];
				s.parentNode.insertBefore(ga, s);
			})();
		</script>
</head>
<body>
		<?php if (sfConfig::get("homeHeader", false)): ?>
			<?php include_partial('global/header'); ?>
		<?php else: ?>
			<?php include_partial('global/in_header'); ?>
		<?php endif ?>
		<main id="siteMain" role="main">
			<?php echo $sf_content ?>
		</main>
		<?php include_partial('global/footer'); ?>
		<?php if (sfConfig::get('sf_environment') == 'prod'): ?>
			<script async src="<?php echo public_path("/js3/main.min{$cacheVersion}.js") ?>"></script>
		<?php else: ?>
			<script async src="<?php echo public_path("/js2/lib/require{$cacheVersion}.js") ?>" data-main="<?php echo public_path("/js2/app") ?>"></script>
		<?php endif ?>
		<script>
			function cbCss() {
				var l = document.createElement('link');
				l.rel = 'stylesheet';
				l.href = '<?php echo public_path("/css2/app{$cacheVersion}.css") ?>';
				var h = document.getElementsByTagName('head')[0];
				h.parentNode.insertBefore(l, h);
			}
			var raf = requestAnimationFrame || mozRequestAnimationFrame || webkitRequestAnimationFrame || msRequestAnimationFrame;
			if (raf) {
				raf(cbCss);
			} else {
				window.addEventListener('load', cbCss);
			}
		</script>
</body>
</html>
