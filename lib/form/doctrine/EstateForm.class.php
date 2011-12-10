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
            'type_id',
            'disponibilidades_list',
            'neighborhood_id',
            'referencia',
            'titulo',
            'price_rent',
            'price_sale',
            'ativo',
            'destaque_chamada',
            'destaque',
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
        
        $this->widgetSchema['type_id']->setLabel('Tipo do imóvel')->setAttributes(array("title"=>"Tipo do imóvel","class"=>"required"));
        $this->widgetSchema['neighborhood_id']->setLabel('Bairro')->setAttributes(array("title"=>"Bairro","class"=>"required"));
        $this->widgetSchema['referencia']->setLabel('Referência')->setAttributes(array("title"=>"Referência","class"=>"required"));
        $this->widgetSchema['titulo']->setLabel('Título')->setAttributes(array("title"=>"Título","class"=>"required xxlarge"));
        $this->widgetSchema['price_rent']->setLabel('Preço aluguel')->setAttributes(array("title"=>"Preço aluguel","class"=>"required"));
        $this->widgetSchema['price_sale']->setLabel('Preço venda')->setAttributes(array("title"=>"Preço venda","class"=>"required"));
        $this->widgetSchema['ativo']->setLabel('Ativo');
        $this->widgetSchema['destaque_chamada']->setLabel('Destaque')->setAttributes(array("class"=>"xxlarge"));
        $this->widgetSchema['destaque']->setLabel('Destaque ativo');
        
        $this->widgetSchema['suites']->setLabel('Nº de suítes');
        $this->widgetSchema['quartos']->setLabel('Nº de quartos');
        $this->widgetSchema['banheiros']->setLabel('Nº de banheiros');
        $this->widgetSchema['vagas']->setLabel('Nº de vagas');
        $this->widgetSchema['empregadas']->setLabel('Nº de quartos de empregada');
        $this->widgetSchema['iptu']->setLabel('IPTU');
        $this->widgetSchema['condominio']->setLabel('Condomínio');
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
        
        // $this->validatorSchema['section_id'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Section'), 'required' => true));
        // $this->validatorSchema['title'] = new sfValidatorString(array('max_length' => 255,'required' => true));
        // $this->validatorSchema['description'] = new sfValidatorString(array('required' => true));
        // $this->validatorSchema['content'] = new sfValidatorString(array('required' => false));
        // $this->validatorSchema['seo'] = new sfValidatorString(array('required' => false));
        // $this->validatorSchema['is_active'] = new sfValidatorBoolean(array('required' => false));
        // $this->validatorSchema['tags_list'] = new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Tag', 'required' => false));
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
