<?php

/**
* Estate form.
*
* @package    sfProject
* @subpackage form
* @author     Thiago Lagden
* @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
*/

class EstateForm extends BaseEstateForm
{
    public function configure()
    {
        $this->useFields(array(
            'ativo',
            'destaque',
            'destaque_chamada',
            'disponibilidades_list',
            'type_id',
            'neighborhood_id',
            'referencia',
            'titulo',
            'price_rent',
            'price_sale',
            'suites',
            'quartos',
            'banheiros',
            'vagas',
            'empregadas',
            'iptu',
            'condominio',
            'area_util',
            'area_total',
            'complementos_list',
            'descricao',
            'seo',
            'tags_list',
        ));

        $model=$this->getObject();

        $this->widgetSchema['neighborhood_id'] = new sfWidgetFormDoctrineChoice([
          'model' => $this->getRelatedModelName('Neighborhood'),
          'add_empty' => true,
          'method' => 'getNeighborhoodCity',
          'table_method' => 'getLista',
        ]);
        $this->widgetSchema['neighborhood_id']->setLabel('Cidade / Bairro')->setAttributes(array("title"=>"Cidade / Bairro","class"=>"required"));

        $this->widgetSchema['type_id']->setLabel('Tipo do imóvel')->setAttributes(array("title"=>"Tipo do imóvel","class"=>"required"));
        $this->widgetSchema['referencia']->setLabel('Referência')->setAttributes(array("title"=>"Referência","class"=>"required"));
        $this->widgetSchema['titulo']->setLabel('Título')->setAttributes(array("title"=>"Título","class"=>"required xxlarge"));

        $this->widgetSchema['price_rent']
            ->setLabel('Preço aluguel')
            ->setAttributes(array("title"=>"Preço aluguel","class"=>"required validate-currency-real",'value'=>$model::getCurrency($model->price_rent)));

        $this->widgetSchema['price_sale']
            ->setLabel('Preço venda')
            ->setAttributes(array("title"=>"Preço venda","class"=>"required validate-currency-real",'value'=>$model::getCurrency($model->price_sale)));

        $this->widgetSchema['ativo']->setLabel('Ativo');
        $this->widgetSchema['destaque_chamada']->setLabel('Destaque')->setAttributes(array("class"=>"xxlarge"));
        $this->widgetSchema['destaque']->setLabel('Destaque ativo');

        $this->widgetSchema['suites']->setLabel('Nº de suítes')->setAttributes(array("title"=>"Nº de suítes","class"=>"small required validate-integer"));
        $this->widgetSchema['quartos']->setLabel('Nº de quartos')->setAttributes(array("title"=>"Nº de quartos","class"=>"small required validate-integer"));
        $this->widgetSchema['banheiros']->setLabel('Nº de banheiros')->setAttributes(array("title"=>"Nº de banheiros","class"=>"small required validate-integer"));
        $this->widgetSchema['vagas']->setLabel('Nº de vagas')->setAttributes(array("title"=>"Nº de vagas","class"=>"small required validate-integer"));
        $this->widgetSchema['empregadas']->setLabel('Nº de quartos de empregada')->setAttributes(array("title"=>"Nº de quartos de empregada","class"=>"small required validate-integer"));

        $this->widgetSchema['iptu']
            ->setLabel('IPTU')
            ->setAttributes(array("title"=>"IPTU","class"=>"required validate-currency-real",'value'=>$model::getCurrency($model->iptu)));

        $this->widgetSchema['condominio']
            ->setLabel('Condomínio')->setAttributes(array("title"=>"Condomínio","class"=>"required validate-currency-real",'value'=>$model::getCurrency($model->condominio)));

        $this->widgetSchema['area_util']->setLabel('Área útil');
        $this->widgetSchema['area_total']->setLabel('Área total');
        $this->widgetSchema['descricao']->setLabel('Descrição')->setAttributes(array("class"=>"xxlarge"));
        $this->widgetSchema['seo']->setLabel('SEO')->setAttributes(array("class"=>"xxlarge"));

        $this->widgetSchema['tags_list']->setLabel('Tags');

        $this->widgetSchema['disponibilidades_list'] = new sfWidgetFormDoctrineChoice(array(
            'expanded'=>true,'multiple' => true, 'model' => 'Disponibilidade',
            'renderer_options' => array('formatter' => array($this, 'formatter'))
        ));
        $this->widgetSchema['disponibilidades_list']->setLabel('Disponibilidade')->setAttributes(array("title"=>"Disponibilidade","class"=>"required"));

        $this->widgetSchema['complementos_list'] = new sfWidgetFormDoctrineChoice(array(
            'expanded'=>true,'multiple' => true, 'model' => 'Complemento',
            'renderer_options' => array('formatter' => array($this, 'formatter'))
        ));
        $this->widgetSchema['complementos_list']->setLabel('Complementos');

        // Validation
        // Default message errors
        sfValidatorBase::setDefaultMessage('required', 'Este campo é obrigatório.');
        sfValidatorBase::setDefaultMessage('invalid', 'A informação que você digitou é inválida.');

        $this->validatorSchema['type_id'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Type'), 'required' => true));
        $this->validatorSchema['disponibilidades_list'] = new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Disponibilidade', 'required' => true));
        $this->validatorSchema['neighborhood_id'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Neighborhood'), 'required' => true));
        $this->validatorSchema['referencia'] = new sfValidatorString(array('max_length' => 255, 'required' => true));
        $this->validatorSchema['titulo'] = new sfValidatorString(array('max_length' => 255, 'required' => true));
        $this->validatorSchema['price_sale'] = new sfValidatorRegex(array('pattern' => '/^(\d{1,3}(\.\d{3})*|(\d+))(\,\d{2})?$/', 'required' => false));
        $this->validatorSchema['price_rent'] = new sfValidatorRegex(array('pattern' => '/^(\d{1,3}(\.\d{3})*|(\d+))(\,\d{2})?$/', 'required' => false));
        $this->validatorSchema['iptu'] = new sfValidatorRegex(array('pattern' => '/^(\d{1,3}(\.\d{3})*|(\d+))(\,\d{2})?$/', 'required' => false));
        $this->validatorSchema['condominio'] = new sfValidatorRegex(array('pattern' => '/^(\d{1,3}(\.\d{3})*|(\d+))(\,\d{2})?$/', 'required' => false));
    }

    public function pictureRadioFormatterCallback($widget, $inputs)
    {
        $rows = array();
        foreach ($inputs as $input)
        {
            $rows[] = $widget->renderContentTag('li', $input['input']);
        }
        return $rows;
    }

    public function formatter($widget, $inputs)
    {
        $rows = array();
        $choices = $widget->getChoices();
        $cc=1;
        foreach ($inputs as $i => $input)
        {
            $rows[] = $widget->renderContentTag(
            'li',
            $widget->renderContentTag('label',"{$input['input']}<span>{$choices[$cc]}</span>",array())
            ,array());
            $cc++;
        }
        return $widget->renderContentTag('ul', implode($widget->getOption('separator'), $rows), array('class' => 'inputs-list'));
    }
}
