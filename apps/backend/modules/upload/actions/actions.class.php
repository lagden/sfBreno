<?php

/**
* upload actions.
*
* @package    sfProject
* @subpackage upload
* @author     Thiago Lagden
* @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
*/
class uploadActions extends sfActions
{
    // Faz Upload das Imagens
    public function executeUploading(sfWebRequest $request)
    {
        $this->getResponse()->setContentType('application/json');

        $estate_id = $request->getPostParameter('estate_id',null);
        $name = $request->getPostParameter('name',null);
        $rnd = $request->getPostParameter('rnd',null);

        $chunk = $request->getPostParameter('chunk',null);
        $chunks = $request->getPostParameter('chunks',null);

        if($chunks > 1)
        {
            $filename = "{$estate_id}_{$rnd}_{$name}";
            $clean=false;
            if(isset($_FILES['file']['tmp_name']) && is_uploaded_file($_FILES['file']['tmp_name']))
            {
                $tmp = $_FILES['file']['tmp_name'];
                $clean = true;
            }
            else
            {
                $tmp = "php://input";
            }
            $in = fopen($tmp, "rb");
            $out = fopen(sfConfig::get('sf_upload_dir') . DIRECTORY_SEPARATOR . $filename, $chunk == 0 ? "wb" : "ab");
            if(!$out) return $this->renderText('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}}');
            if(!$in) return $this->renderText('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}}');
            while ($buff = fread($in, 4096)) fwrite($out, $buff);
            fclose($in);
            fclose($out);
            if($clean) @unlink($_FILES['file']['tmp_name']);
            if($chunks==($chunk+1))
            {
                $form = new ImageChunkForm();
                $form->bind(array('estate_id'=>$estate_id,'file'=>$filename));
            }
            else return $this->renderText(json_encode(array($chunks=>$chunk+1)));
        }
        else
        {
            $form = new ImageForm();
            $form->bind(array('estate_id'=>$estate_id),$request->getFiles());
        }

        $response = [
            'jsonrpc'=>'2.0',
            'error'=>[
                'code'=>'103',
                'message'=>'Failed to move uploaded file.',
            ],
            'success' => false,
            'auth' => true,
            'data' => null,
        ];

        if ($form->isValid()) {
          $image = $form->save();
          if ($image) {
            unset($response['error']);

            $response['success']=true;
            $response['data'] = [
              'id'=>$image->id,
              'file'=>$image->formato('s'),
              'file2x'=>$image->formato('s2x'),
              'destaque'=>$image->destaque,
            ];
            return $this->renderText(json_encode($response));
          } else {
            $response['error']['code']='105';
            $response['error']['message']='Failed to save on database.';
            return $this->renderText(json_encode($response));
          }
        }
        return $this->renderText(json_encode($response));
    }

    // Ajax Add File
    public function executeAddFile(sfWebRequest $request)
    {
        $this->getResponse()->setContentType('text/plain');

        // Verifica a sessão
        $auth = $this->getUser()->isAuthenticated();
        if(!$auth)
          return $this->renderText("end_of_session");

        return $this->renderPartial('global/file', [
          'id' => $request['id'],
          'file' => $request['file'],
          'file2x' => $request['file2x'],
          'destaque' => $request['destaque']
        ]);
    }

    // Ajax Remove File
    public function executeRemoveFile(sfWebRequest $request)
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

        // Verificando Method
        if($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::DELETE))
        {
            $result = Doctrine_Core::getTable('Image')->find($request['id']);
        }
        else
        {
            $response['msg']="Os métodos permitidos são: POST ou DELETE.";
        }

        // Do it
        if( $result )
        {
            $result->delete();
            $response['success']=true;
            $response['msg']="O arquivo foi removido com sucesso.";
            $response['data']=array('id'=>$request['id']);
        }
        else
        {
            $response['msg']="Arquivo não encontrado.";
        }
        return $this->renderText(json_encode($response));
    }

    // Ajax Destaque File
    public function executeDestaque(sfWebRequest $request)
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

        // Verificando Method
        if($request->isMethod(sfRequest::POST))
        {
            $table = Doctrine_Core::getTable('Image');
            $result = $table->find($request['id']);
        }
        else
        {
            $response['msg']="O método permitido: POST.";
        }

        // Do it
        if( $result && $table)
        {
            $imgs = $table->findByEstateId($result->estate_id);
            if($imgs->count()>0)
            {
                foreach ($imgs as $img)
                {
                    $img->destaque = ($img->id == $result->id) ? 1 : 0;
                    $img->save();
                }
            }
            $response['success']=true;
            $response['msg']="O arquivo está setado como destaque.";
            $response['data']=array('id'=>$request['id']);
        }
        else
        {
            $response['msg']="Arquivo não encontrado.";
        }
        return $this->renderText(json_encode($response));
    }
}
