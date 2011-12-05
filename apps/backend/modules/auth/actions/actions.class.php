<?php

/**
* auth actions.
*
* @package    sfProject
* @subpackage auth
* @author     Thiago Lagden
* @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
*/
class authActions extends sfActions
{
    public function executeIndex(sfWebRequest $request)
    {
        // Clear Auth
        $this->getUser()->setAttribute(sfConfig::get('app_session_user_id'),null);
        $this->getUser()->clearCredentials();
        $this->getUser()->setAuthenticated(false);
        sfConfig::set('module_auth',true);
        $this->form = new AuthForm();
    }

    public function executeLogout(sfWebRequest $request)
    {
        $this->getUser()->setAttribute('referer',false);
        $this->forward('auth','index');
    }

    // Auth Rest Json
    public function executeLogin(sfWebRequest $request)
    {
        $this->getResponse()->setContentType('application/json');

        // Response
        $response=array(
            'success' => false,
            'auth' => true,
            'msg' => 'Erro',
            'data' => null,
        );

        $form = new AuthForm();
        $form->bind($request->getParameter($form->getName()),$request->getFiles($form->getName()));

        if ($form->isValid())
        {
            $login = $form['login']->getValue();
            $password = $form['password']->getValue();

            $user = Doctrine_Core::getTable('User')->getValidatedUser($login,$password);

            if($user)
            {
                $permission = sfConfig::get('app_admin_credential','administrador');
                $this->getUser()->setAuthenticated(true);
                $this->getUser()->addCredentials($permission);
                $this->getUser()->setAttribute(sfConfig::get('app_session_user_id'),$user->id);
                $this->getUser()->setAttribute(sfConfig::get('app_session_user_name'),$user->name);
                $this->getUser()->setAttribute(sfConfig::get('app_session_user_credential'),$permission);

                // Load Helper
                $this->getContext()->getConfiguration()->loadHelpers(array('Url'));

                switch($permission)
                {
                    case sfConfig::get('app_admin_credential'):
                    case sfConfig::get('app_editor_credential'):
                    $referer=$this->getUser()->getAttribute('referer',false);
                    $response['data']['url'] = ($referer) ? $referer : url_for('user');
                    $response['success']=true;
                    break;

                    default:
                    $response['msg'] = 'Sem permissão de acesso ao sistema de administração.';
                }
            }
            else
            {
                $response['msg'] = 'Login ou senha inválida.';
            }
        }
        else
        {
            $response['msg'] = 'Dados inválidos.';
        }
        return $this->renderText(json_encode($response));
    }
}
