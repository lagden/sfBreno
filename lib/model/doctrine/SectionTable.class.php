<?php

/**
* SectionTable
* 
* This class has been auto-generated by the Doctrine ORM Framework
*/
class SectionTable extends Doctrine_Table
{
    /**
    * Returns an instance of this class.
    *
    * @return object SectionTable
    */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Section');
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