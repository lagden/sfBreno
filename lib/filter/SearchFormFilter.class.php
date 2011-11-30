<?php
class SearchFormFilter extends sfFormFilter
{
    public function configure()
    {
        $this->widgetSchema['q'] = new sfWidgetFormInput(array('label' => 'Palavra-chave'));
        $this->validatorSchema['q'] = new sfValidatorPass;
        $this->widgetSchema->setNameFormat('searchfilter[%s]');
    }
}
