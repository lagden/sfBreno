<?php
class ContatoForm extends sfForm
{
    public function configure()
    {
        $this->setWidgets(array(
            'nome' => new sfWidgetFormInput(array('label' => 'Nome',),array('placeholder'=>'Informe seu nome',)),
            'email' => new sfWidgetFormInput(array('label' => 'E-mail',),array('placeholder'=>'Informe seu e-mail',)),
            'telefone' => new sfWidgetFormInput(array('label' => 'Telefone',),array('placeholder'=>'Informe seu telefone',)),
            'msg' => new sfWidgetFormTextarea(array('label' => 'Mensagem',),array('placeholder'=>'Deixe uma mensagem',)),
            'ref' => new sfWidgetFormInputHidden(),
            'slug' => new sfWidgetFormInputHidden(),
        ));

        $this->widgetSchema->setNameFormat('contato[%s]');

        // Default message errors
        sfValidatorBase::setDefaultMessage('required', 'Este campo é obrigatório.');
        sfValidatorBase::setDefaultMessage('invalid', 'A informação que você digitou é inválida.');

        $this->setValidators(array(
            'nome' => new sfValidatorString(array('required' => true)),
            'email' => new sfValidatorEmail(array('required' => true)),
            'telefone' => new sfValidatorString(array('required' => false)),
            'msg' => new sfValidatorString(array('required' => false)),
            'ref' => new sfValidatorString(array('required' => false)),
            'slug' => new sfValidatorString(array('required' => false)),
        ));
    }
}