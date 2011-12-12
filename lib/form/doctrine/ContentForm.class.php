<?php

/**
* Content form.
*
* @package    sfProject
* @subpackage form
* @author     Thiago Lagden
* @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
*/
class ContentForm extends BaseContentForm
{
    public function configure()
    {
        $this->useFields(array('section_id','title','description','content','seo','tags_list','is_active','position'));
        
        $this->widgetSchema['section_id']->setLabel('Seção')->setAttributes(array("title"=>"Seção","class"=>"required"));
        $this->widgetSchema['title']->setLabel('Título')->setAttributes(array("title"=>"Título","class"=>"required"));
        $this->widgetSchema['description']->setLabel('Descrição')->setAttributes(array("title"=>"Descrição","class"=>"required xxlarge"));
        $this->widgetSchema['content']->setLabel('Conteúdo')->setAttributes(array("class"=>"xxlarge tinymce"));
        $this->widgetSchema['seo']->setLabel('SEO')->setAttributes(array("class"=>"xxlarge"));
        $this->widgetSchema['is_active']->setLabel('Ativado');
        $this->widgetSchema['tags_list']->setLabel('Tags');
        $this->widgetSchema['position']->setLabel('Posição');
        
        // Validation
        // Default message errors
        sfValidatorBase::setDefaultMessage('required', 'Este campo é obrigatório.');
        sfValidatorBase::setDefaultMessage('invalid', 'A informação que você digitou é inválida.');
        
        $this->validatorSchema['section_id'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Section'), 'required' => true));
        $this->validatorSchema['title'] = new sfValidatorString(array('max_length' => 255,'required' => true));
        $this->validatorSchema['description'] = new sfValidatorString(array('required' => true));
        $this->validatorSchema['content'] = new sfValidatorString(array('required' => false));
        $this->validatorSchema['seo'] = new sfValidatorString(array('required' => false));
        $this->validatorSchema['is_active'] = new sfValidatorBoolean(array('required' => false));
        $this->validatorSchema['tags_list'] = new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Tag', 'required' => false));
        $this->validatorSchema['position'] = new sfValidatorInteger(array('required' => false));
    }
}
