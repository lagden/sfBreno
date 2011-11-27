<?php
class Filter
{
    /**
    *
    * @author Thiago Lagden
    */
    public static function query(array $filters,array $fields,$table,$name='q')
    {
        $q=$table->getListQuery();
        $alias = $q->getRootAlias();

        if (isset($filters[$name]) && $filters[$name])
        {
            // Removendo palavras pequenas
            $fixQ=static::fix($filters[$name]);

            // Searchable
            if(method_exists($table,'search'))
            {
                $search = $table->search($fixQ);
                $arr=array();
                foreach($search as $v)$arr[]=$v['id'];
                if(count($arr)>0)$q->orWhereIn("{$alias}.id", $arr);
            }
            foreach($fields as $field)
            {
                $q->orWhere("{$alias}.{$field} LIKE :q", array(':q'=>"%{$filters[$name]}%"));
            }
        }

        // Sort
        $order=sfContext::getInstance()->getUser()->getAttribute(sfConfig::get('order_by'),'id');
        $direction=sfContext::getInstance()->getUser()->getAttribute(sfConfig::get('order_by_direction'),'DESC');
        $q->orderBy("{$alias}.{$order} $direction");

        return $q;
    }

    public static function fix($q)
    {
        $a=explode(' ',$q);
        if(count($a)<2)return $q;
        $r=array();
        foreach($a as $v)
        {
            if(strlen($v)>2)$r[]=$v;
        }
        return join(' ',$r);
    }

    public static function execute()
    {
        $filterForm=sfConfig::get('formFilter');
        $filters=static::get();
        $form=new $filterForm($filters);
        return $form;
    }

    public static function get()
    {
        return sfContext::getInstance()->getUser()->getAttribute(sfConfig::get('cookie_search'),array());
    }

    public static function set($filters)
    {
        return sfContext::getInstance()->getUser()->setAttribute(sfConfig::get('cookie_search'), $filters);
    }
}