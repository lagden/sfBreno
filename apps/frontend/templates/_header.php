<header id="siteHeader" class="header-bg">
	<h1 class="header__title">
		<svg class="logo-breno">
			<use xlink:href="#custom_breno-wide"><?php echo sfConfig::get('title_site',$sf_response->getTitle()) ?></use>
		</svg>
	</h1>
	<?php include_component('home', 'Menu', ['css'=>'nav--header', 'sufix'=>'Header']); ?>
	<div class="burger-bl">
		<button id="burger" type="button" class="burger close"><span class="burger__icon"></span></button>
	</div>
</header>
<?php include_component('home', 'Menu', ['css'=>'nav--out', 'sufix'=>'Out']); ?>
