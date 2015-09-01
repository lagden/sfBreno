<?php
if($pager->haveToPaginate()) {
	echo Pagina::show($pager->getPage(), $pager->getLastPage(), $route);
}
