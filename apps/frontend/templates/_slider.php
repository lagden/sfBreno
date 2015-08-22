<div id="homeGallery" class="gallery home-gallery">
	<div id="staticBannerHome" class="static-banner--home">Some text</div>
	<?php foreach ($destaques as $destaque): ?>
		<?php
		$img1x = $destaque->image_destaque->formato('b');
		$img2x = $destaque->image_destaque->formato('b2x');
		$qs = ['slug'=>$destaque->slug];
		$img = "<img src=\"{$img1x}\" srcset=\"{$img1x} 1x, {$img2x} 2x\" alt=\"{$qs['slug']}\">";
		$link = link_to($img, 'estate_show', $qs);
		?>
		<div class="gallery-cell">
			<?php echo $link ?>
			<p class="gallery__caption"><?php echo link_to("{$destaque->destaque_chamada}", 'estate_show', $qs); ?></p>
		</div>
	<?php endforeach ?>
</div>
