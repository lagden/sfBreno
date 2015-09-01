<?php
class ContatoForm extends sfForm
{
    public function configure()
    {
        $this->setWidgets([
            'nome'     => new sfWidgetFormInput(['label'=> 'Nome'], ['placeholder'=>'Informe seu nome']),
            'email'    => new sfWidgetFormInput(['label'=> 'E-mail'], ['placeholder'=>'Informe seu e-mail', 'type'=>'email']),
            'telefone' => new sfWidgetFormInput(['label'=> 'Telefone'], ['placeholder'=>'Informe seu telefone', 'type'=>'tel']),
            'msg'      => new sfWidgetFormTextarea(['label'=> 'Mensagem'], ['placeholder'=>'Deixe uma mensagem']),
            'ref'      => new sfWidgetFormInputHidden(),
            'slug'     => new sfWidgetFormInputHidden(),
        ]);

        $this->widgetSchema->setNameFormat('contato[%s]');

        // Default message errors
        sfValidatorBase::setDefaultMessage('required', 'Este campo é obrigatório.');
        sfValidatorBase::setDefaultMessage('invalid', 'A informação que você digitou é inválida.');

        $this->setValidators([
            'nome'     => new sfValidatorString(['required'=> true]),
            'email'    => new sfValidatorEmail(['required'=> true]),
            'telefone' => new sfValidatorString(['required'=> true]),
            'msg'      => new sfValidatorString(['required'=> false]),
            'ref'      => new sfValidatorString(['required'=> false]),
            'slug'     => new sfValidatorString(['required'=> false]),
        ]);
    }
}