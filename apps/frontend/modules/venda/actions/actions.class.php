<?php

/**
* venda actions.
*
* @package    sfProject
* @subpackage venda
* @author     Thiago Lagden
* @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
*/
class vendaActions extends sfActions
{
    public function executeIndex(sfWebRequest $request)
    {
        Xtras::metas('venda');
        $this->form = new VendaForm();
    }

    // Ajax Form Contato
    public function executeContato(sfWebRequest $request)
    {
        $this->getResponse()->setContentType('application/json');

        // Response
        $response=array(
            'success' => false,
            'auth' => true,
            'msg' => 'Erro',
            'data' => null,
        );

        $form = new VendaForm();
        $post = $request->getParameter($form->getName());
        $form->bind($post, $request->getFiles($form->getName()));

        if ($form->isValid())
        {
            $r = $this->enviaEmail($post);
            if($r)
            {
                $response['success']=true;
                $response['msg']='Enviado com sucesso.';
            }
            else
            {
                $response['msg']='Falha ao tentar enviar. Tente novamente.';
            }
        }
        else $response['msg']='Formulário inválido.';
        return $this->renderText(json_encode($response));
    }

    public function enviaEmail($post)
    {
        $message = $this->getMailer()->compose();
        $message->setSubject('Breno Homara Imóveis [Venda ou alugue seu imóvel]');
        $message->setTo(sfConfig::get('app_send_to'));
        $message->setFrom(sfConfig::get('app_master_email'), "{$post['nome']}");
        $html = $this->getPartial('global/email_venda', array('post' => $post));
        $message->setBody($html, 'text/html');
        return $this->getMailer()->send($message);
    }
}
