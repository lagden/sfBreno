<?php

/**
* home actions.
*
* @package    sfProject
* @subpackage home
* @author     Thiago Lagden
* @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
*/
class homeActions extends sfActions
{
    public function executeIndex(sfWebRequest $request)
    {
        $estateTable = Doctrine_Core::getTable('Estate');
        $this->estates = $estateTable->getRnd(12)->execute();
        $this->destaques = $estateTable->getDestaques()->execute();
    }
}
