<?php
class Utils
{
    /**
    *
    * @author Thiago Lagden
    */
    static public function log($content,$file)
    {
        file_put_contents($file,$content,FILE_APPEND);
    }
    
    public static function date($date,$format='d/m/Y')
    {
        try
        {
            $d = new DateTime($date);
            return $d->format($format);
        }
        catch (Exception $e)
        {
            return null;
        }
    }

    public static function regexValidador($str, $pattern)
    {
        return preg_match($pattern, $str);
    }

    public static function emailValidador($str)
    {
        return static::regexValidador($str,'/^([^@\s]+)@((?:[-a-z0-9]+\.)+[a-z]{2,})$/i');
    }

    public static function diff($date1,$date2="now")
    {
        $d1 = strtotime($date1);
        $d2 = strtotime($date2);
        return $d1 - $d2;
    }

    public static function toMysql($date)
    {
        preg_match('/^(0[1-9]|[12][0-9]|3[01])[- \/\.](0[1-9]|1[012])[- \/\.](\d{4})$/', $date, $matches);
        if(count($matches))
        {
            return "{$matches[3]}-{$matches[2]}-{$matches[1]}";
        }else return null;
    }
    
    static public function getJoin($es,$f='name')
    {
        $arr = array();
        foreach ($es as $e) {
            $arr[]=$e->$f;
        }
        return join(', ',$arr);
    }

    public static function trace(){
        $args=func_get_args();
        $r="";
        foreach($args as $k=>$arg){
            $r.="{$k}: ".print_r($arg,true)."\n";
        }
        echo "<code><pre>{$r}</pre></code>";
    }
}