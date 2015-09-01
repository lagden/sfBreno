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
        $slug = $request->getParameter('slug', false);
        $arr = [
        	'sobre' => 'Sobre',
        	'administracao-de-imoveis-e-servicos' => 'Administração de Imóveis',
        	'administracao-de-imoveis' => 'Administração de Imóveis',
        	'documentacao-necessaria' => 'Documentação Necessária',
        ];

        if ($slug) {
        	$c = Helper::getMD($slug);
        	$this->title = isset($arr[$slug]) ? $arr[$slug] : '';
        }

        if(!$c) {
        	$this->redirect('site_notfound');
        } else {
            $this->getResponse()->addMeta('title', $this->title, true, true);
            $this->c = $c;
        }
    }

    public function executeNotFound(sfWebRequest $request)
    {
        // Not Found
    }
}
