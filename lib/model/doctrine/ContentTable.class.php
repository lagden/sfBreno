<?php

/**
* ContentTable
* 
* This class has been auto-generated by the Doctrine ORM Framework
*/
class ContentTable extends Doctrine_Table
{
    /**
    * Returns an instance of this class.
    *
    * @return object ContentTable
    */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Content');
    }
    
    public function getByTag($tag, $active=1, Doctrine_Query $q = null)
    {
        if (null === $q) $q = $this->getListQuery();
        $alias=$q->getRootAlias();
        $q->innerJoin("{$alias}.Tags t");
        $q->andWhere("t.slug = ?", $tag);
        $q->andWhere("{$alias}.is_active = ?", $active);
        $q->orderBy("{$alias}.section_id, {$alias}.position ASC");
        return $q;
    }

    // Filtro
    public function getListFilter(array $filters, Doctrine_Query $q = null)
    {
        return Filter::query($filters,sfContext::getInstance()->getUser()->getAttribute('search_list.fields'),static::getInstance());
    }

    public function getListQuery(Doctrine_Query $q = null)
    {
        if(null === $q)$q = $this->createQuery('a');
        return $q;
    }
}