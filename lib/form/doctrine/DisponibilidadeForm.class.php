<?php

/**
* Disponibilidade form.
*
* @package    sfProject
* @subpackage form
* @author     Thiago Lagden
* @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
*/
class DisponibilidadeForm extends BaseDisponibilidadeForm
{
    public function configure()
    {
        $this->useFields(array('name'));
        
        $this->widgetSchema['name']->setLabel('Disponibilidade')->setAttributes(array("title"=>"Disponibilidade","class"=>"required"));
        
        // Validation
        // Default message errors
        sfValidatorBase::setDefaultMessage('required', 'Este campo é obrigatório.');
        sfValidatorBase::setDefaultMessage('invalid', 'A informação que você digitou é inválida.');

        $this->validatorSchema['name'] = new sfValidatorString(array('required' => true));
    }
}
