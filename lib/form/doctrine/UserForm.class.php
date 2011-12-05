<?php
/**
* User form.
*
* @package    sfProject
* @subpackage form
* @author     Thiago Lagden
* @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
*/
class UserForm extends BaseUserForm
{
    public function configure()
    {
        $this->useFields(array('name','email','phone','login','password'));
        
        $this->widgetSchema['name']->setLabel('Nome')->setAttributes(array("title"=>"Nome","class"=>"required"));
        $this->widgetSchema['email']->setLabel('E-mail')->setAttributes(array("title"=>"E-mail","class"=>"required validate-email"));
        $this->widgetSchema['phone']->setLabel('Telefone');
        $this->widgetSchema['login']->setLabel('Login')->setAttributes(array("title"=>"Login","class"=>"required"));
        $this->widgetSchema['password']->setLabel('Senha');
        $this->widgetSchema['change'] = new sfWidgetFormInputCheckbox(array('value_attribute_value' => 1, 'default' => false));
        $this->widgetSchema['change']->setLabel('Alterar a senha?')->setAttributes(array("class"=>"changePassword"));

        // Validation
        // Default message errors
        sfValidatorBase::setDefaultMessage('required', 'Este campo é obrigatório.');
        sfValidatorBase::setDefaultMessage('invalid', 'A informação que você digitou é inválida.');

        $this->validatorSchema['name'] = new sfValidatorString(array('required' => true));
        $this->validatorSchema['email'] = new sfValidatorEmail(array('required' => true));
        $this->validatorSchema['login'] = new sfValidatorString(array('required' => true));
        $this->validatorSchema['password'] = new sfValidatorString(array('required' => false));
        $this->validatorSchema['phone'] = new sfValidatorString(array('required' => false));
        $this->validatorSchema['change'] = new sfValidatorInteger(array('required' => false));

        $this->validatorSchema->setPostValidator(
            new sfValidatorAnd(array(
                new sfValidatorDoctrineUnique(array('model' => 'User', 'column' => array('email')),array('invalid' => 'Este email já está sendo utilizado.')),
                new sfValidatorDoctrineUnique(array('model' => 'User', 'column' => array('login')),array('invalid' => 'Este login já está sendo utilizado.')),
            ))
        );
    }
}
