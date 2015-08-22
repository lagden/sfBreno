<nav id="navbar<?php echo $sufix ?>" class="navbar <?php echo $css ?>">
	<ul class="nav navbar__ul">
		<?php
		foreach ($menus as $menu):
				$lnk=($menu->route) ? url_for($menu->route) : url_for('site',array('slug'=>$menu->slug));
				$a = link_to($menu->title,$lnk);
				$classes = Menu::match($a,$_SERVER['REQUEST_URI']);
				$a = link_to($menu->title,$lnk,array('class'=>join(' ',$classes)));
				echo content_tag('li',$a);
		endforeach;
		?>
	</ul>
</nav>
