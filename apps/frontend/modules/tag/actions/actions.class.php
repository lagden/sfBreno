<?php

/**
* tag actions.
*
* @package    sfProject
* @subpackage tag
* @author     Thiago Lagden
* @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
*/
class tagActions extends sfActions
{
    public function executeIndex(sfWebRequest $request)
    {
        $slug = $request->getParameter('slug',false);
        
        $tagTable = Doctrine_Core::getTable('Tag');
        $this->tag = $tagTable->findOneBySlug($slug);
        
        $sectionTable = Doctrine_Core::getTable('Section');
        $contentTable = Doctrine_Core::getTable('Content');
        $estateTable = Doctrine_Core::getTable('Estate');
        
        if($this->tag)
        {
            $this->sections = $sectionTable->getByTag($slug)->execute();
            $this->contents = $contentTable->getByTag($slug)->execute();
            $this->estates = $estateTable->getByTag($slug)->execute();
        }
        else
        {
            $this->redirect('tag_notfound');
        }
    }
    
    public function executeNotFound(sfWebRequest $request)
    {
        // Not Found
    }
}
