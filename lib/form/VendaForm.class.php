<?php
class VendaForm extends sfForm
{
    public function configure()
    {
        $this->setWidgets(array(
            'nome' => new sfWidgetFormInput(array('label' => '* Nome',),array('placeholder'=>'Informe seu nome',)),
            'email' => new sfWidgetFormInput(array('label' => '* E-mail',),array('placeholder'=>'Informe seu e-mail',)),
            'telefone' => new sfWidgetFormInput(array('label' => 'Telefone',),array('placeholder'=>'Informe seu telefone',)),
            'disponibilidade' => new sfWidgetFormChoice(array(
                'label' => '* Eu gostaria de:',
                'choices'  => array('Vender ou alugar'=>'Vender ou alugar','Vender'=>'Vender','Alugar'=>'Alugar',),
                'multiple' => false,
                'expanded' => true,
                'default' => 'Vender ou alugar',
            )),
            'tipo' => new sfWidgetFormDoctrineChoice(array(
                'label' => '* Tipo',
                'key_method' => 'getName',
                'model' => 'Type',
                'multiple' => false,
                'expanded' => true,
                'default' => 'Apartamento',
            )),
            'bairro' => new sfWidgetFormInput(array('label' => '* Bairro',),array('placeholder'=>'Informe o Bairro',)),
            'quartos' => new sfWidgetFormInput(array('label' => 'Nº de quartos',),array('placeholder'=>'Informe o Nº de quartos',)),
            'suites' => new sfWidgetFormInput(array('label' => 'Nº de suítes',),array('placeholder'=>'Informe o Nº de suítes',)),
            'banheiros' => new sfWidgetFormInput(array('label' => 'Nº de banheiros',),array('placeholder'=>'Informe o Nº de banheiros',)),
            'vagas' => new sfWidgetFormInput(array('label' => 'Nº de vagas',),array('placeholder'=>'Informe o Nº de vagas',)),
            'valor' => new sfWidgetFormInput(array('label' => '* Valor',),array('placeholder'=>'Informe o valor',)),
            'descricao' => new sfWidgetFormTextarea(array('label' => '* Descrição',),array('placeholder'=>'Faça uma breve descrição',)),
        ));

        $this->widgetSchema->setNameFormat('venda[%s]');

        // Default message errors
        sfValidatorBase::setDefaultMessage('required', 'Este campo é obrigatório.');
        sfValidatorBase::setDefaultMessage('invalid', 'A informação que você digitou é inválida.');

        $this->setValidators(array(
            'nome' => new sfValidatorString(array('required' => true)),
            'email' => new sfValidatorEmail(array('required' => true)),
            'telefone' => new sfValidatorString(array('required' => false)),
            'disponibilidade' => new sfValidatorString(array('required' => true)),
            'tipo' => new sfValidatorString(array('required' => true)),
            'bairro' => new sfValidatorString(array('required' => true)),
            'quartos' => new sfValidatorString(array('required' => false)),
            'suites' => new sfValidatorString(array('required' => false)),
            'banheiros' => new sfValidatorString(array('required' => false)),
            'vagas' => new sfValidatorString(array('required' => false)),
            'valor' => new sfValidatorString(array('required' => true)),
            'descricao' => new sfValidatorString(array('required' => true)),
        ));
    }
}