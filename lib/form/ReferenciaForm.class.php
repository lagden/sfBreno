<?php
class ReferenciaForm extends sfForm
{
    public function configure()
    {
        $this->setWidgets(array(
            'referencia' => new sfWidgetFormInput(array('label' => 'Código de referência',),array('placeholder'=>'Informe o código de referência',)),
        ));

        $this->widgetSchema->setNameFormat('ref[%s]');

        // Default message errors
        sfValidatorBase::setDefaultMessage('required', 'Este campo é obrigatório.');
        sfValidatorBase::setDefaultMessage('invalid', 'A informação que você digitou é inválida.');

        $this->setValidators(array(
            'referencia' => new sfValidatorString(array('required' => true)),
        ));
    }
}