<?php
include_once '../lib/vendor/symfony/lib/helper/UrlHelper.php';
include_once '../lib/vendor/symfony/lib/helper/TagHelper.php';

class Menu
{
    static public function dropdown($arr,$uri=null,$css="nav")
    {
        $close = false;
        $drop = ($css) ? '<ul class="'.$css.'">' : '<ul>';
        foreach($arr as $k=>$v)
        {
            $label = isset($v['label']) ? $v['label'] : false;
            $ac = isset($v['a_class']) ? $v['a_class'] : false;
            $c = isset($v['class']) ? $v['class'] : false;
            $a = ($v['route']) ? '<a href="'.url_for($v['route']).'" class="' . $ac . '">' . $label . '</a>' : '<a href="javascript:;" class="' . $ac . '">' . $label . '</a>';
            $classes = static::match($a,$uri,$c);

            if($c == 'divider')
            {
                $drop.='<li class="divider"></li>';
            }
            else
            {
                $drop.='<li'.((count($classes)>0)?' class="'.join(' ',$classes).'"':'').'>'. $a ;
            }

            if(isset($v['children']))
            {
                $drop.=static::dropdown($v['children'],$uri,'dropdown-menu');
                $close=true;
            }
            else
            {
                $drop.='</li>';
                $close=false;
            }
            if($close) $drop.='</li>';
        }
        $drop.='</ul>';
        return $drop;
    }

    static public function match($a,$uri,$c=false)
    {
        $classes=array();
        $regex= '/<a(.*)href=(\'|")([\?\=\-a-zA-Z-0-9_%\.:\/]*)/i';
        preg_match($regex,$a,$matches);
        if($matches[3]==$uri) $classes[]="active";
        if($c) $classes[]=$c;
        return $classes;
    }
}
