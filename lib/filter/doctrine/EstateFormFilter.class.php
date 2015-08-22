<?php

/**
* Estate filter form.
*
* @package    sfProject
* @subpackage filter
* @author     Thiago Lagden
* @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
*/
class EstateFormFilter extends BaseEstateFormFilter
{
    public function configure()
    {
        $this->useFields(array(
          'type_id',
        ));

        $this->widgetSchema['type_id'] = new sfWidgetFormDoctrineChoice(array(
            'model' => $this->getRelatedModelName('Type'),
            'multiple' => false,
            'expanded' => false,
            'default' => 1,
        ));

        $this->widgetSchema['Disponibilidades'] = new sfWidgetFormDoctrineChoice(array(
            'model' => $this->getRelatedModelName('Disponibilidades'),
            'multiple' => false,
            'expanded' => true,
            'add_empty' => 'Selecione',
        ));

        $this->widgetSchema['valor'] = new sfWidgetFormChoice(array(
            'choices' => array('Indiferente')
        ));

        $this->widgetSchema['neighborhood_id'] = new sfWidgetFormDoctrineChoice(array(
            'model' => $this->getRelatedModelName('Neighborhood'),
            'method' => 'getNeighborhoodCity',
            'multiple' => true,
            'expanded' => true,
        ));

        $this->widgetSchema['suites'] = new sfWidgetFormChoice(array(
            'choices'  => Doctrine_Core::getTable('Estate')->getNumbers(),
            'multiple' => true,
            'expanded' => true,
            'renderer_class' => 'DropdowCheckbox'
        ));

        $this->widgetSchema['quartos'] = new sfWidgetFormChoice(array(
            'choices'  => Doctrine_Core::getTable('Estate')->getNumbers(),
            'multiple' => true,
            'expanded' => true,
            'renderer_class' => 'DropdowCheckbox'
        ));

        $this->widgetSchema['banheiros'] = new sfWidgetFormChoice(array(
            'choices'  => Doctrine_Core::getTable('Estate')->getNumbers(),
            'multiple' => true,
            'expanded' => true,
            'renderer_class' => 'DropdowCheckbox'
        ));

        $this->widgetSchema['vagas'] = new sfWidgetFormChoice(array(
            'choices'  => Doctrine_Core::getTable('Estate')->getNumbers(),
            'multiple' => true,
            'expanded' => true,
            'renderer_class' => 'DropdowCheckbox'
        ));

        $this->widgetSchema['area_util'] = new sfWidgetFormChoice(array(
            'choices'  => Doctrine_Core::getTable('Estate')->getArea(),
        ));

        $this->widgetSchema['type_id']->setLabel('Selecione uma opção');
        $this->widgetSchema['Disponibilidades']->setLabel('Disponibilidade');
        $this->widgetSchema['valor']->setLabel('Valor');
        $this->widgetSchema['neighborhood_id']->setLabel('Bairros');
        $this->widgetSchema['suites']->setLabel('Suítes');
        $this->widgetSchema['quartos']->setLabel('Quartos');
        $this->widgetSchema['banheiros']->setLabel('Banheiros');
        $this->widgetSchema['vagas']->setLabel('Vagas');
        $this->widgetSchema['area_util']->setLabel('Área');

        // Validation
        // Default message errors
        sfValidatorBase::setDefaultMessage('required', 'Este campo é obrigatório.');
        sfValidatorBase::setDefaultMessage('invalid', 'A informação que você digitou é inválida.');

    }
}

class DropdowCheckbox extends sfWidgetFormChoiceBase
{
    public function render($name, $value = null, $attributes = array(), $errors = array())
    {
        $result = ['<ul>'];
        $choices = $this->getChoices();
        foreach ($choices as $k => $choice) {
            $tmp = [
              '<li>',
              '<label class="media">',
              '<input type="checkbox" class="media__figure opt-drop" ',
              'name="'.$name.'" value="'.$k.'" '.(($value == $k) ? 'checked' : '').'>',
              '<span class="media__body">'.$choice.'</span>',
              '</label>',
              '</li>'
            ];
            $result = array_merge($result, $tmp);
        }
        array_push($result, '</ul>');
        return implode('', $result);
    }
}
