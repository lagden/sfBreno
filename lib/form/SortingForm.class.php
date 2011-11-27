<?php
class SortingForm extends sfForm
{
    public function configure()
    {
        $sorting = Doctrine_Core::getTable('Estate')->getSorting();
        $this->setWidgets(array(
            'sorting' => new sfWidgetFormChoice(array(
                'choices'  => $sorting,
                'label' => 'Ordenar',
            )),
        ));

        $this->widgetSchema->setNameFormat('sort[%s]');

        // Default message errors
        sfValidatorBase::setDefaultMessage('required', 'Este campo é obrigatório.');
        sfValidatorBase::setDefaultMessage('invalid', 'A informação que você digitou é inválida.');

        $this->setValidators(array(
            'sorting' => new sfValidatorChoice(array('choices'=> $sorting, 'required' => false)),
        ));
    }
}