<?php
class Xtras
{
    /**
    *
    * @author Thiago Lagden
    */

    // Referer for session expired
    public static function referer()
    {
        sfContext::getInstance()->getUser()->setAttribute('referer',$_SERVER['PHP_SELF']);
        return null;
    }

    // Paging
    public static function getPager($query, $request, $model)
    {
        $pagina=$request->getParameter('pagina',1);
        sfConfig::set('pagina',$pagina);
        $pager = new sfDoctrinePager($model,sfConfig::get('app_search_max_per_page'));
        $pager->setQuery($query);
        $pager->setPage($pagina);
        $pager->init();
        return $pager;
    }

    // CRUD - Listagem
    public static function lista($request)
    {
        // Referer
        Xtras::referer();
        // Title
        sfConfig::set('section',sfConfig::get('title_list'));
        // Valores
        $values=Filter::get();
        // Query
        $query=Doctrine_Core::getTable(sfConfig::get('table_model'))->getListFilter( $values );
        // Pagination
        return Xtras::getPager($query,$request,sfConfig::get('table_model'));
    }

    // CRUD - Sortable Ajax - Return HTML
    public static function sort($request)
    {
        // Verifica a sessão
        $auth = sfContext::getInstance()->getUser()->isAuthenticated();
        if(!$auth){
            return "reload";
        }

        sfContext::getInstance()->getUser()->setAttribute(sfConfig::get('order_by'), $request->getParameter('field','id'));
        sfContext::getInstance()->getUser()->setAttribute(sfConfig::get('order_by_direction'), $request->getParameter('direction','DESC'));

        // Valores
        $values=Filter::get();

        // Query
        $query=Doctrine_Core::getTable(sfConfig::get('table_model'))->getListFilter( $values );
        $pager=Xtras::getPager($query,$request,sfConfig::get('table_model'));
        return $pager;
    }

    // CRUD - Delete Ajax - Return JSON
    public static function delete($request)
    {
        // Response
        $response=array(
            'success' => false,
            'auth' => true,
            'msg' => 'Erro',
            'data' => null,
        );

        // Verifica a sessão
        $auth = sfContext::getInstance()->getUser()->isAuthenticated();
        if(!$auth)
        {
            $response['auth']=false;
            $response['msg']="Sessão expirada. Efetue o login novamente.";
            return json_encode($response);
        }

        // Somente Admin
        $admin = sfContext::getInstance()->getUser()->hasCredential('administrador');

        // Verificando Method
        if($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::DELETE))
        {
            $result = Doctrine_Core::getTable(sfConfig::get('table_model'))->find($request['id']);
        }
        else
        {
            $response['msg']="Os métodos permitidos são: POST ou DELETE.";
        }

        // Do it
        if( $result && $admin )
        {
            try
            {
                $result->delete();
                $response['success']=true;
                $response['msg']="O registro foi removido com sucesso.";
                $response['data']=array('id'=>$request['id']);
                sfContext::getInstance()->getUser()->setAttribute(sfConfig::get('last_edited'), null);
                return json_encode($response);
            }
            catch (Exception $e)
            {
                $response['msg']="Não foi possível remover o registro.";
                return json_encode($response);
            }
        }
        else
        {
            $response['msg']="Registro não encontrado.";
            return json_encode($response);
        }
        return json_encode($response);
    }

    // Post Helper
    public static function helper($request,$form)
    {
        $post=$request->getParameter($form->getName());
        $link=$request->getParameter('link');

        // Dates
        $dates = array('date_ini','date_end');
        foreach($dates as $date){
            if(isset($post[$date]))
            {
                preg_match('/^(0[1-9]|[12][0-9]|3[01])[- \/\.](0[1-9]|1[012])[- \/\.](\d{4})$/', $post[$date], $matches);
                if(count($matches))
                {
                    $post[$date]="{$matches[3]}-{$matches[2]}-{$matches[1]}";
                }
            }
        }

        // Json Encode
        $jsons = array('moment_time','frequency_week','frequency_month');
        foreach($jsons as $json){
            if(isset($post[$json]))
            {
                $post[$json] = json_encode($post[$json]);
            }
        }

        // Tags
        if(isset($post['tags_list']))
        {
            $tagTable = Doctrine_Core::getTable('Tag');
            $post['tags_list'] = $tagTable->findByNameOrCreate($post['tags_list']);
        }

        // Links
        if($link)
        {
            $revert=array();
            foreach($link as $k => $v)
            {
                foreach($v as $a => $b)
                {
                    $revert[$a][$k]=$b;
                }
            }

            $linkTable = Doctrine_Core::getTable('Link');
            $post['links_list'] = $linkTable->findByNameOrCreate($revert);
        }

        return $post;
    }
}