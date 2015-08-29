<div class="bloco bloco--light">
	<div class="gs gs--flex">
	<?php
	foreach($estates as $estate) {
		include_partial('global/estate', ['estate' => $estate]);
	}
	?>
	</div>
</div>
