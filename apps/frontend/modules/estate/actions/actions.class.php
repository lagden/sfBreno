<?php

/**
* estate actions.
*
* @package    sfProject
* @subpackage estate
* @author     Thiago Lagden
* @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
*/
class estateActions extends GeneralActions
{
    // Listagem
    public function executeIndex(sfWebRequest $request)
    {
        // Setup App
        static::setup();
        $this->pager=static::lista($request);
    }
    
    public static function lista($request)
    {
        // Valores
        $values=Filter::get();
        // Query
        $query=Doctrine_Core::getTable(sfConfig::get('table_model'))->getFrontListFilter( $values );
        // Pagination
        return Xtras::getPager($query,$request,sfConfig::get('table_model'));
    }
    
    public function executeShow(sfWebRequest $request)
    {
        //
    }
    
    // Ajax Referencia - Retorna a url do imovel se existir
    public function executeReferencia(sfWebRequest $request)
    {
        //
    }
    
    // Ajax Disponibilidade - Retorna os valores de acordo
    public function executeDisponibilidade(sfWebRequest $request)
    {
        // Route: estate_disponibilidade
        $this->getResponse()->setContentType('application/json');

        // Response
        $response=array(
            'success' => false,
            'auth' => true,
            'msg' => 'Erro',
            'data' => null,
        );
        
        $d = $request->getPostParameter('disponibilidade',false);
        
        if($d)
        {
            $func = ($d == 1) ? "getValorVenda" : "getValorAluguel";
            $response['success']=true;
            $response['data']=array('combo'=>Doctrine_Core::getTable('Estate')->$func());
        }
        return $this->renderText(json_encode($response));
    }
    
    // Setup
    static public function setup()
    {
        $prefix="estate";
        $prefix_uc="Estate";
        $single="imóvel";
        $single_uc="Imóvel";
        $plural="imóveis";
        $plural_uc="Imóveis";
        $new = (true) ? 'Novo':'Nova';

        // App
        sfConfig::set("table_model","{$prefix_uc}"); // Table Model Class
        sfConfig::set("redirect_index","{$prefix}"); // Index Rota
                
        // Filter
        sfConfig::set("formFilter",sfConfig::get("app_formfilter_estate","EstateFormFilter")); // Filter Form
        sfConfig::set("cookie_search","{$prefix}_site_search.filters"); // Filter Form result
        sfConfig::set("route_form_filter",sfConfig::get("app_route_form_filter","estate_filter")); // Route form submit
        sfConfig::set("route_form_filter_reset","{$prefix}_clear"); // Route clear form
        
        // Others
        sfConfig::set("component_class","{$prefix}"); // Nome da classe
        sfConfig::set("page_route","{$prefix}_page"); // Rota para paginacao
        
        // Sort
        sfConfig::set("action_sort","{$prefix}_sort");
        sfConfig::set("order_by","{$prefix}_sort.field");
        sfConfig::set("order_by_direction","{$prefix}_sort.direction");
    }
}
