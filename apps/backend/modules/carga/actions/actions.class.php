<?php

/**
* carga actions.
*
* @package    sfProject
* @subpackage carga
* @author     Thiago Lagden
* @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
*/
class cargaActions extends sfActions
{
    public function executeIndex(sfWebRequest $request)
    {
        // Code
    }

    public function executeRun(sfWebRequest $request)
    {
        $this->getResponse()->setContentType('application/json');
        // Response
        $response=array(
            'success' => false,
            'auth' => true,
            'msg' => 'Erro',
            'data' => null,
        );

        // Verifica a sessão
        $auth = $this->getUser()->isAuthenticated();
        if(!$auth){
            $response['auth']=false;
            $response['msg']="Sessão expirada. Efetue o login novamente.";
            return $this->renderText(json_encode($response));
        }
        
        $ds=DIRECTORY_SEPARATOR;
        $bin=sfConfig::get('sf_root_dir')."{$ds}bin{$ds}";
        exec("{$bin}check.sh",$outchk);
        
        $outchk = (isset($outchk[0]) && $outchk[0]=="true") ? true : false;
        if($outchk)
        {
            $response['msg']='A carga já está execução. Aguarde sua finalização para iniciar uma próxima.';
        }
        else
        {
            //exec("{$bin}run.sh {$bin}carga.sh");
            exec("{$bin}carga.sh",$oo);
            var_dump($oo);
            $response['msg']='Iniciado a execução da carga. Um email será disparado avisando quando a carga estiver completa.';
        }
        return $this->renderText(json_encode($response));
    }
}