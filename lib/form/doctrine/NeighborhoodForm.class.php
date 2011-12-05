<?php

/**
* Neighborhood form.
*
* @package    sfProject
* @subpackage form
* @author     Thiago Lagden
* @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
*/
class NeighborhoodForm extends BaseNeighborhoodForm
{
    public function configure()
    {
        $this->useFields(array('name','city_id'));
        
        $this->widgetSchema['city_id']->setLabel('Cidade')->setAttributes(array("title"=>"Cidade","class"=>"required"));
        $this->widgetSchema['name']->setLabel('Bairro')->setAttributes(array("title"=>"Bairro","class"=>"required"));
        
        // Validation
        // Default message errors
        sfValidatorBase::setDefaultMessage('required', 'Este campo é obrigatório.');
        sfValidatorBase::setDefaultMessage('invalid', 'A informação que você digitou é inválida.');

        $this->validatorSchema['name'] = new sfValidatorString(array('required' => true));
        $this->validatorSchema['city_id'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('City'), 'required' => true));
    }
}
