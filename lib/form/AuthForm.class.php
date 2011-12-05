<?php
class AuthForm extends sfForm
{
    public function configure()
    {
        $this->setWidgets(array(
            'login' => new sfWidgetFormInput(array('label' => 'Login',),array('title'=>'Login','class'=>'required','placeholder'=>'Informe seu login',)),
            'password' => new sfWidgetFormInputPassword(array('label' => 'Senha'),array('title'=>'Senha','class'=>'required','placeholder'=>'Informe sua senha',)), 
        ));

        $this->widgetSchema->setNameFormat('auth[%s]');

        // Default message errors
        sfValidatorBase::setDefaultMessage('required', 'Este campo é obrigatório.');
        sfValidatorBase::setDefaultMessage('invalid', 'A informação que você digitou é inválida.');

        $this->setValidators(array(
            'login' => new sfValidatorString(array('required' => true)), 
            'password' => new sfValidatorString(array('required' => true)),
        ));
    }
}
