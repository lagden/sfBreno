<?php

/**
* sitemap actions.
*
* @package    sfProject
* @subpackage sitemap
* @author     Thiago Lagden
* @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
*/
class sitemapActions extends sfActions
{
    public function executeIndex(sfWebRequest $request)
    {
        $this->getResponse()->setContentType('text/xml');
        $this->context->getConfiguration()->loadHelpers(array('Url'));

        $item = array();
        $xml = new Xml(false,false);
        $item['sitemapindex']['__attr']['xmlns']="http://www.sitemaps.org/schemas/sitemap/0.9";

        // Section
        $item['sitemapindex']['__node'][0]['sitemap']['__node']['loc']['__text']=url_for('sitemap_type',array('type'=>'section','sf_format'=>'xml'),true);
        $item['sitemapindex']['__node'][0]['sitemap']['__node']['lastmod']['__text']=date('c');

        // Content
        $item['sitemapindex']['__node'][1]['sitemap']['__node']['loc']['__text']=url_for('sitemap_type',array('type'=>'content','sf_format'=>'xml'),true);
        $item['sitemapindex']['__node'][1]['sitemap']['__node']['lastmod']['__text']=date('c');

        // Estate
        $item['sitemapindex']['__node'][2]['sitemap']['__node']['loc']['__text']=url_for('sitemap_type',array('type'=>'estate','sf_format'=>'xml'),true);
        $item['sitemapindex']['__node'][2]['sitemap']['__node']['lastmod']['__text']=date('c');

        // Tag
        $item['sitemapindex']['__node'][3]['sitemap']['__node']['loc']['__text']=url_for('sitemap_type',array('type'=>'tag','sf_format'=>'xml'),true);
        $item['sitemapindex']['__node'][3]['sitemap']['__node']['lastmod']['__text']=date('c');

        // Render
        $xml->fromArray($item);
        $xml->end();
        $xmlOut=$xml->output();
        return $this->renderText($xmlOut);
    }

    public function executeMaps(sfWebRequest $request)
    {
        $this->getResponse()->setContentType('text/xml');
        $this->context->getConfiguration()->loadHelpers(array('Url'));

        $type=$request['type'];

        $cc=0;
        $item = array();
        $xml = new Xml(false,false);
        $item['urlset']['__attr']['xmlns:xsi']="http://www.w3.org/2001/XMLSchema-instance";
        $item['urlset']['__attr']['xsi:schemaLocation']="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd";
        $item['urlset']['__attr']['xmlns']="http://www.sitemaps.org/schemas/sitemap/0.9";

        // Section
        if($type == 'section')
        {
            $vs = Doctrine_Core::getTable('Section')->findAll();
            foreach($vs as $v):
                $currUrl = ($v->route) ? url_for($v->route,array(),true) : url_for('site',array('slug'=>$v->slug),true);
                $item['urlset']['__node'][$cc]['url']['__node']['loc']['__text']=$currUrl;
                $item['urlset']['__node'][$cc]['url']['__node']['lastmod']['__text']=Utils::date($v->updated_at,'c');
                $item['urlset']['__node'][$cc]['url']['__node']['priority']['__text']='0.9';
                $cc++;
            endforeach;
        }

        // Content
        if($type == 'content')
        {
            $vs = Doctrine_Core::getTable('Content')->findAll();
            foreach($vs as $v):
                if($v->Section->count()>0)
                {
                    $item['urlset']['__node'][$cc]['url']['__node']['loc']['__text']=url_for('site_content',array('section'=>$v->Section->slug,'slug'=>$v->slug),true);
                    $item['urlset']['__node'][$cc]['url']['__node']['lastmod']['__text']=Utils::date($v->updated_at,'c');
                    $item['urlset']['__node'][$cc]['url']['__node']['priority']['__text']='0.7';
                    $cc++;
                }
            endforeach;
        }

        // Estate
        if($type == 'estate')
        {
            $vs = Doctrine_Core::getTable('Estate')->findAll();
            foreach($vs as $v):
                $item['urlset']['__node'][$cc]['url']['__node']['loc']['__text']=url_for('estate_show',array('slug'=>$v->slug),true);
                $item['urlset']['__node'][$cc]['url']['__node']['lastmod']['__text']=Utils::date($v->updated_at,'c');
                $item['urlset']['__node'][$cc]['url']['__node']['priority']['__text']='1';
                $cc++;
            endforeach;
        }

        // Tags
        if($type == 'tag')
        {
            $vs = Doctrine_Core::getTable('Tag')->findAll();
            foreach($vs as $v):
                $item['urlset']['__node'][$cc]['url']['__node']['loc']['__text']=url_for('tag',array('slug'=>$v->slug),true);
                $item['urlset']['__node'][$cc]['url']['__node']['lastmod']['__text']=Utils::date($v->updated_at,'c');
                $item['urlset']['__node'][$cc]['url']['__node']['priority']['__text']='0.8';
                $cc++;
            endforeach;
        }

        $xml->fromArray($item);
        $xml->end();
        $xmlOut=$xml->output();
        return $this->renderText($xmlOut);
    }
}