<?php

/**
* site actions.
*
* @package    sfProject
* @subpackage site
* @author     Thiago Lagden
* @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
*/
class siteActions extends sfActions
{
    public function executeIndex(sfWebRequest $request)
    {
        $slug = $request->getParameter('slug',false);
        $section = $request->getParameter('section',false);
        
        $sectionTable = Doctrine_Core::getTable('Section');
        $contentTable = Doctrine_Core::getTable('Content');
        
        $c=false;
        $this->contentAsSection=false;
        
        if($slug && $section)
        {
            $this->s=$sectionTable->findOneBySlug($section);
            $c=$contentTable->findOneBySlugAndSectionId($slug,$this->s->id);
        }
        elseif($slug)
        {
            $this->contentAsSection=true;
            $c=$sectionTable->findOneBySlug($slug);
        }
        if(!$c) $this->redirect('site_notfound');
        else
        {
            $this->getResponse()->addMeta('title', $c->title, true, true);
            $this->getResponse()->addMeta('description', $c->description, true, true);
            if($c->Tags->count()>0)
            {
                $this->getResponse()->addMeta('keywords', $c->joinTags, true, true);    
            }
            if($c->seo) sfConfig::set('seo_site',$c->seo);
            $this->c = $c;
        }
    }
    
    public function executeNotFound(sfWebRequest $request)
    {
        // Not Found
    }
}
