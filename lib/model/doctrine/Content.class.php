<?php

/**
* Content
* 
* This class has been auto-generated by the Doctrine ORM Framework
* 
* @package    sfProject
* @subpackage model
* @author     Thiago Lagden
* @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
*/
class Content extends BaseContent
{
    public function getAtivado()
    {
        return ($this->is_active) ? "Sim" : "Não";
    }
    
    public function getJoinTags()
    {
        return Utils::getJoin($this->Tags);
    }
}
