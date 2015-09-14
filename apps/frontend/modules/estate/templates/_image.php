<?php if ($estate->Images->count() > 0): ?>
	<div id="estateGallery" class="gallery estate-gallery" data-isMobile="<?php echo IS_MOBILE ? 1 : 0 ?>">
		<?php foreach ($estate->Images as $image): ?>
			<?php
			$img1x = $image->formato('m');
			$img2x = $image->formato('m2x');
			$imgB = $image->formato('b2x');
			$img = "<img src=\"{$img1x}\" srcset=\"{$img1x} 1x, {$img2x} 2x\" alt=\"{$estate->slug}\">";
			?>
			<div class="gallery-cell">
				<a class="picWorks" href="<?php echo $imgB ?>"><?php echo $img ?></a>
			</div>
		<?php endforeach ?>
	</div>
<?php endif; ?>
