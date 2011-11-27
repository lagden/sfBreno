<?php
class GeneralActions extends sfActions
{
    // Listagem
    public function executeIndex(sfWebRequest $request)
    {
        // Setup App
        static::setup();
        $this->pager=Xtras::lista($request);
    }

    public function executeClear(sfWebRequest $request)
    {
        // Setup App
        static::setup();
        // Limpa cookie do filtro
        Filter::set(null);
        $request->setParameter('pagina',1);
        $this->redirect(sfConfig::get('redirect_index'));
    }

    public function executeFilter(sfWebRequest $request)
    {
        // Setup App
        static::setup();
        // Filtro
        $filterForm = sfConfig::get('formFilter');
        $filter = new $filterForm;
        $filterParams = $request->getParameter($filter->getName());
        // Seta cookie do filtro
        Filter::set($filterParams);
        // Seta a pagina para 1
        $request->setParameter('pagina',1);
        $this->redirect(sfConfig::get('redirect_index'));
    }

    public function executeSort(sfWebRequest $request)
    {
        // Setup App
        static::setup();
        $this->getResponse()->setContentType('text/plain');
        $response=Xtras::sort($request);
        if(is_string($response)&&$response=="reload")return $this->renderText($response);
        else
        {
            return $this->renderPartial(sfConfig::get("tbody",'global/tbody'),array(
                'fields' => array('labels'=>sfConfig::get('fields_labels',array()),'names'=>sfConfig::get('fields_names',array()),'sorts'=>sfConfig::get('fields_sorts',array()),'xtras'=>sfConfig::get('fields_xtras',array()),),
                'actions' => array('edit'=>sfConfig::get('action_edit'),'delete'=>sfConfig::get('action_delete'),'new'=>sfConfig::get('action_new'),),
                'itens' => $response->getResults(),
            ));
        }
    }

    /* CRUD
    ---------------------------------------------------------------------------------*/
    public function executeNew(sfWebRequest $request)
    {
        self::newOrEdit($request,true);
    }

    public function executeEdit(sfWebRequest $request)
    {
        self::newOrEdit($request);
    }

    public function executeCreate(sfWebRequest $request)
    {
        self::createOrUpdate($request,true);
    }

    public function executeUpdate(sfWebRequest $request)
    {
        self::createOrUpdate($request);
    }

    protected function newOrEdit(sfWebRequest $request, $is_new=false)
    {
        // Setup App
        static::setup();
        // Referer
        Xtras::referer();
        $formModel = sfConfig::get('form_model');
        if($is_new)
        {
            sfConfig::set('section',sfConfig::get('title_new'));
            $this->form = new $formModel();
        }
        else
        {
            sfConfig::set('section',sfConfig::get('title_edit'));
            $obj = Doctrine_Core::getTable(sfConfig::get('table_model'))->find($request['id']);
            $this->forward404Unless('Objeto não encontrado');
            // Ultimo Editado
            $this->getUser()->setAttribute(sfConfig::get('last_edited'), $request['id']);
            $this->form = new $formModel($obj);
        }
    }

    protected function createOrUpdate(sfWebRequest $request, $is_new=false)
    {
        // Setup App
        static::setup();
        $formModel=sfConfig::get('form_model');
        if($is_new)
        {
            sfConfig::set('section',sfConfig::get('title_new'));
            $template='new';
            $this->forward404Unless($request->isMethod(sfRequest::POST));
            $this->form = new $formModel();
        }
        else
        {
            sfConfig::set('section',sfConfig::get('title_edit'));
            $template='edit';
            $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT),'Os métodos permitidos são POST ou PUT.');
            $obj = Doctrine_Core::getTable(sfConfig::get('table_model'))->find($request['id']);
            $this->forward404Unless($obj,'Objeto não encontrado');
            $this->form = new $formModel($obj);
        }
        self::processForm($request, $this->form);
        $this->setTemplate($template);
    }

    private function processForm(sfWebRequest $request, sfForm $form)
    {
        $post=Xtras::helper($request,$form);

        $form->bind($post, $request->getFiles($form->getName()));
        if ($form->isValid())
        {
            $obj = $form->save();
            if($obj)
            {
                $notice = 'Dados gravados com sucesso.';
                $this->getUser()->setFlash('notice', "{$notice}", true);
                $this->getUser()->setAttribute(sfConfig::get('last_edited'), $obj->id);
                $this->redirect(sfConfig::get('redirect_index'));
            }
            else
            {
                $notice = 'Falha ao gravar.';
                $this->getUser()->setFlash('notice', "{$notice}", true);
            }
        }
    }

    /* Ajax Delete
    ---------------------------------------------------------------------------------*/
    public function executeDelete(sfWebRequest $request)
    {
        // Setup App
        static::setup();
        $this->getResponse()->setContentType('application/json');
        return $this->renderText(Xtras::delete($request));
    }

    /* End CRUD
    ---------------------------------------------------------------------------------*/

    static public function setup()
    {
        // Code...
    }
}
