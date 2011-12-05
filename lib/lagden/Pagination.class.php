<?php
include_once '../lib/vendor/symfony/lib/helper/UrlHelper.php';
include_once '../lib/vendor/symfony/lib/helper/TagHelper.php';

class Pagination
{
    static public $merge=array();
    public static function show($page=1,$pages=1,$route=null,$xtras=array(),$lang='pt-BR')
    {
        static::$merge=$xtras;
        $adjacents=3;
        $prev=$page-1;
        $next=$page+1;
        $lastpage=$pages;
        $lpm=$pages-1;

        // $anteriorLang=array('pt-BR'=>'❮','en'=>'Prior','es'=>'Anterior');
        $anteriorLang=array('pt-BR'=>'Anterior','en'=>'Prior','es'=>'Anterior');
        //$proximoLang=array('pt-BR'=>'❯','en'=>'Next','es'=>'Pr&#243;ximo');
        $proximoLang=array('pt-BR'=>'Próximo','en'=>'Next','es'=>'Pr&#243;ximo');
        $paginaLang=array('pt-BR'=>'P&#225;gina','en'=>'Page','es'=>'P&#225;gina');

        $anterior='<button type="button" data-pagina="'.static::buildUrl($route,array('pagina' => $prev)).'" class="prior paginacao paginacaoUI">'.$anteriorLang[$lang].'</button>';
        $anteriorD='<button type="button" class="priorD paginacaoDisabled paginacaoUI">'.$anteriorLang[$lang].'</button>';
        $proximo='<button type="button" data-pagina="'.static::buildUrl($route,array('pagina' => $next)).'" class="next paginacao paginacaoUI">'.$proximoLang[$lang].'</button>';
        $proximoD='<button type="button" class="nextD paginacaoDisabled paginacaoUI">'.$proximoLang[$lang].'</button>';

        $pagination='<div class="pagination">';
        // $pagination.="<span>{$paginaLang[$lang]} {$page}/{$pages}</span>";

        if($lastpage > 1)
        {
            $pagination.=" ";
            //previous button
            if ($page > 1)$pagination.= $anterior;
            else $pagination.= $anteriorD;  //disabled

            //pages 
            if($lastpage < 7 + ($adjacents * 2))
            { 
                for($counter = 1; $counter <= $lastpage; $counter++)$pagination.=static::countPage($counter,$page,$route);
            }
            elseif($lastpage > 5 + ($adjacents * 2))
            {
                if($page < 1 + ($adjacents * 2))
                {
                    for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)$pagination.=static::countPage($counter,$page,$route);
                    $pagination.=static::lastPage($lpm,$lastpage,$route);
                }
                elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
                {
                    $pagination.=static::oneTwo($route);
                    for($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)$pagination.=static::countPage($counter,$page,$route);
                    $pagination.=static::lastPage($lpm,$lastpage,$route);
                }
                else
                {
                    $pagination.=static::oneTwo($route);
                    for($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)$pagination.=static::countPage($counter,$page,$route);
                }
            }
            //next button
            if ($page < $counter - 1)$pagination.=$proximo;
            else $pagination.=$proximoD;
        }

        $pagination.='</div>';

        return $pagination;
    }

    protected static function countPage($counter,$page,$route)
    {
        if($counter == $page)return '<button type="button" class="paginacaoSelecionado paginacaoUI">'.$counter.'</button>';
        else return '<button type="button" data-pagina="'.static::buildUrl($route,array('pagina' => $counter)).'" class="paginacao paginacaoUI">'.$counter.'</button>';
    }

    protected static function lastPage($lpm,$lastpage,$route)
    {
        return '
            <button type="button" class="paginacaoUI">...</button>
        <button type="button" data-pagina="'.static::buildUrl($route,array('pagina' => $lpm)).'" class="paginacao paginacaoUI">'.$lpm.'</button>
        <button type="button" data-pagina="'.static::buildUrl($route,array('pagina' => $lastpage)).'" class="paginacao paginacaoUI">'.$lastpage.'</button>
        ';
    }

    protected static function oneTwo($route)
    {
        return '
            <button type="button" data-pagina="'.static::buildUrl($route,array('pagina' => 1)).'" class="paginacao paginacaoUI">1</button>
        <button type="button" data-pagina="'.static::buildUrl($route,array('pagina' => 2)).'" class="paginacao paginacaoUI">2</button>
        <button type="button" class="paginacaoUI">...</button>
        ';
    }

    public static function buildUrl($route,$params)
    {
        if(is_object(static::$merge))$result = array_merge($params, static::$merge->getRawValue());
        elseif(is_array(static::$merge))$result = array_merge($params, static::$merge);
        else $result=$params;
        return url_for($route,$result);
    }

}