<?php
include_once '../lib/vendor/symfony/lib/helper/UrlHelper.php';

class Pagina
{
	static public $merge = [];
	public static function show($page=1, $pages=1, $route=null, $xtras=[])
	{
		static::$merge = $xtras;
		$prev = $page - 1;
		$next = $page + 1;

		$preUrl = static::buildUrl($route, ['pagina' => $prev]);
		$nextUrl = static::buildUrl($route, ['pagina' => $next]);
		$okUrl = static::buildUrl($route, ['pagina' => '__num__']);

		$anterior='<button type="button" data-pagina="'.$preUrl.'" class="paginacao__prior paginacao--ui">❮</button>';
		$anteriorD='<button type="button" disabled class="paginacao__prior paginacao--ui">❮</button>';
		$proximo='<button type="button" data-pagina="'.$nextUrl.'" class="paginacao__next paginacao--ui">❯</button>';
		$proximoD='<button type="button" disabled class="paginacao__next paginacao--ui">❯</button>';
		$number='<input type="number" value="'.$page.'" name="quantity" min="1" max="'.$pages.'" class="paginacao--ui">';
		$ok='<button type="button" data-pagina="'.$okUrl.'" class="paginacao__ok paginacao--ui">OK</button>';

		$pagination = ['<div class="pagination">'];
		if ($pages > 1) {
			array_push($pagination, ($page > 1) ? $anterior : $anteriorD);
			array_push($pagination, ($page < $pages) ? $proximo : $proximoD);
			array_push($pagination, $number);
			array_push($pagination, $ok);
		}
		array_push($pagination, '</div>');

		return implode('', $pagination);
	}

	public static function buildUrl($route, $params)
	{
		if(is_object(static::$merge)) {
			$result = array_merge($params, static::$merge->getRawValue());
		} elseif(is_array(static::$merge)) {
			$result = array_merge($params, static::$merge);
		} else {
			$result=$params;
		}
		return url_for($route,$result);
	}

}