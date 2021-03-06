<?php

/**
* disponibilidade actions.
*
* @package    sfProject
* @subpackage disponibilidade
* @author     Thiago Lagden
* @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
*/
class disponibilidadeActions extends GeneralActions
{
    static public function setup()
    {
        // Vars
        $prefix="disponibilidade";
        $prefix_uc="Disponibilidade";
        $single="disponibilidade";
        $single_uc="Disponibilidade";
        $plural="disponibilidades";
        $plural_uc="Disponibilidades";
        $new = (false) ? 'Novo':'Nova';

        // Filtro
        sfConfig::set("formFilter","SearchFormFilter"); // Formulario que sera utilizado no filtro
        sfConfig::set("cookie_search","{$prefix}_search.filters"); // cookie do filtro
        sfConfig::set("component_class","filtro"); // Nome do componente que tem o Filter
        sfConfig::set("route_form_filter","{$prefix}_filter"); // Rota de submit do filtro
        sfConfig::set("route_form_filter_reset","{$prefix}_clear"); // Rota para limpar o filtro
        sfConfig::set("field_form_filter","q"); // Campo do filtro

        // Títulos
        sfConfig::set("title_list","Lista de {$plural}"); // Lista
        sfConfig::set("title_edit","Edita {$single}"); // Edita
        sfConfig::set("title_new","{$new} {$single}"); // Novo

        //Modelo da tabela
        sfConfig::set("table_model","{$prefix_uc}"); // Table Model Class

        // Rotas
        sfConfig::set("redirect_index","{$prefix}"); // Rota do index
        sfConfig::set("page_route","{$prefix}_page"); // Rota para paginacao

        // Sort Table
        sfConfig::set("order_by","{$prefix}_sort.field");
        sfConfig::set("order_by_direction","{$prefix}_sort.direction");

        // Cookie
        sfConfig::set("last_edited","{$prefix}_last.edited");

        // Action List
        sfConfig::set("action_create","{$prefix}_create");
        sfConfig::set("action_update","{$prefix}_update");
        sfConfig::set("action_edit","{$prefix}_edit");
        sfConfig::set("action_delete","{$prefix}_delete");
        sfConfig::set("action_new","{$prefix}_new");
        sfConfig::set("action_sort","{$prefix}_sort");

        // Form
        sfConfig::set("form_model","{$prefix_uc}Form");
        sfConfig::set("form_id","{$prefix}Form");

        // Fields Searchable
        $fields=array("name");
        sfContext::getInstance()->getUser()->setAttribute("search_list.fields", $fields);

        // Table List
        sfConfig::set("fields_labels",array("Ação","Disponibilidade"));
        sfConfig::set("fields_names",array("id","name"));
        sfConfig::set("fields_sorts",array("id","name"));
    }
}
