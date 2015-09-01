<?php

/**
* contato actions.
*
* @package    sfProject
* @subpackage contato
* @author     Thiago Lagden
* @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
*/
class contatoActions extends sfActions
{
    public function executeIndex(sfWebRequest $request)
    {
        Xtras::metas('contato');
        $this->info = sfConfig::get('app_footer');
        sfConfig::set('contato_route','contato_envia');
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

        $form = new ContatoForm();
        $post = $request->getParameter($form->getName());

        $spam = isset($post['outrosstuff']) ? $post['outrosstuff'] : false;
        if($spam === '' || $spam === false) {
          unset($post['outrosstuff']);
        }

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
        } else {
          // Formulário inválido
          $errors = [];
          foreach($form as $k => $v) {
            if ($form[$k]->getError()) {
              array_push($errors, "{$form[$k]->renderLabelName()} - {$form[$k]->getError()}");
            }
          }
          foreach($form->getGlobalErrors() as $k => $v) {
            array_push($errors, $v->__toString());
          }
          $notice = (!empty($errors)) ? join("<br>", $errors) : 'Formulário inválido';
          $response['msg'] = "{$notice}";
        }
        return $this->renderText(json_encode($response));
    }

    public function enviaEmail($post)
    {
        $info = sfConfig::get('app_footer');
        $message = $this->getMailer()->compose();
        $message->setSubject("{$info['site']} [Fale Conosco] [{$post['nome']}]");
        $message->setTo(sfConfig::get('app_send_to'));
        $message->setFrom(sfConfig::get('app_master_email'), "{$post['nome']}");
        $message->setReplyTo($post['email'], "{$post['nome']}");
        $html = $this->getPartial('global/email_contato', array('post' => $post));
        $message->setBody($html, 'text/html');
        return $this->getMailer()->send($message);
    }
}
