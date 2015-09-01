<?php if ($estate->Images->count() > 0): ?>
	<div id="estateGallery" class="gallery estate-gallery">
		<?php foreach ($estate->Images as $image): ?>
			<?php
			$img1x = $image->formato('m');
			$img2x = $image->formato('m2x');
			$img = "<img src=\"{$img1x}\" srcset=\"{$img1x} 1x, {$img2x} 2x\" alt=\"{$estate->slug}\">";
			?>
			<div class="gallery-cell"><?php echo $img ?></div>
		<?php endforeach ?>
	</div>
<?php endif; ?>
