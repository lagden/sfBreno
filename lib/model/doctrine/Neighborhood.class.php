<?php

/**
* Neighborhood
*
* This class has been auto-generated by the Doctrine ORM Framework
*
* @package    sfProject
* @subpackage model
* @author     Thiago Lagden
* @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
*/
class Neighborhood extends BaseNeighborhood
{
    public function getNeighborhoodCity()
    {
        // return "{$this->City->name} - {$this->name}";
        return "{$this->name}";
    }

    public function bairroCidade()
    {
        return "{$this->City->name} / {$this->name}";
    }
}
