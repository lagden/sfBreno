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
				$choices = Doctrine_Core::getTable('Estate')->getNumbers();

				$this->useFields(array(
					'type_id',
				));

				$this->widgetSchema['type_id'] = new sfWidgetFormDoctrineChoice(array(
						'model' => $this->getRelatedModelName('Type'),
						'multiple' => false,
						'expanded' => false,
						// 'default' => 1,
						'add_empty' => 'Todos os tipos'
				));

				$this->widgetSchema['Disponibilidades'] = new sfWidgetFormDoctrineChoice(array(
						'model' => $this->getRelatedModelName('Disponibilidades'),
						'multiple' => false,
						'expanded' => true,
						'renderer_class' => 'RadioButtonGroup',
						// 'default' => 1
				));
				$this->widgetSchema['Disponibilidades']->setAttributes([
					'class' => 'optsDisponibilidades'
				]);

				$this->widgetSchema['valor'] = new sfWidgetFormInputHidden();
				$this->widgetSchema['valor']->setDefault(0);

				$this->widgetSchema['valor_max'] = new sfWidgetFormInputHidden();
				$this->widgetSchema['valor_max']->setDefault(5000);

				$this->widgetSchema['neighborhood_id'] = new sfWidgetFormDoctrineChoice(array(
						'model' => $this->getRelatedModelName('Neighborhood'),
						'method' => 'getNeighborhoodCity',
						'multiple' => false,
						'expanded' => false,
						'table_method' => 'getLista',
						'add_empty' => 'Todos os lugares'
				));

				$this->widgetSchema['suites'] = new sfWidgetFormChoice([
						'choices'  => $choices,
						'multiple' => true,
						'expanded' => true,
						'renderer_class' => 'DropdowCheckbox'
				]);

				$this->widgetSchema['quartos'] = new sfWidgetFormChoice([
						'choices'  => $choices,
						'multiple' => true,
						'expanded' => true,
						'renderer_class' => 'DropdowCheckbox'
				]);

				$this->widgetSchema['banheiros'] = new sfWidgetFormChoice(array(
						'choices'  => $choices,
						'multiple' => true,
						'expanded' => true,
						'renderer_class' => 'DropdowCheckbox'
				));

				$this->widgetSchema['vagas'] = new sfWidgetFormChoice(array(
						'choices'  => $choices,
						'multiple' => true,
						'expanded' => true,
						'renderer_class' => 'DropdowCheckbox'
				));

				$this->widgetSchema['area'] = new sfWidgetFormInputHidden();
				$this->widgetSchema['area']->setDefault(0);
				$this->widgetSchema['area_max'] = new sfWidgetFormInputHidden();
				$this->widgetSchema['area_max']->setDefault(1000);

				$this->widgetSchema['type_id']->setLabel('Selecione uma opção');
				$this->widgetSchema['Disponibilidades']->setLabel('Disponibilidade');
				$this->widgetSchema['valor']->setLabel('Valor');
				$this->widgetSchema['neighborhood_id']->setLabel('Bairros');
				$this->widgetSchema['suites']->setLabel('Suíte');
				$this->widgetSchema['quartos']->setLabel('Quarto');
				$this->widgetSchema['banheiros']->setLabel('Banheiro');
				$this->widgetSchema['vagas']->setLabel('Vaga');
				$this->widgetSchema['area']->setLabel('Área');

				// Validation
				// Default message errors
				sfValidatorBase::setDefaultMessage('required', 'Este campo é obrigatório.');
				sfValidatorBase::setDefaultMessage('invalid', 'A informação que você digitou é inválida.');
		}
}

class DropdowCheckbox extends sfWidgetFormChoiceBase
{
		public function render($name, $value = null, $attributes = [], $errors = [])
		{
				$pattern = '/\[(\w+)\]/i';
				$res = preg_match($pattern, $name, $matches);
				$campo = $matches[1];
				$values = Filter::get();
				$result = ['<ul>'];
				$choices = $this->getChoices();
				$arr = isset($values[$campo]) ? $values[$campo] : [];
				foreach ($choices as $k => $choice) {
						$tmp = [
							'<li>',
							'<label class="media">',
							'<input type="checkbox" class="media__figure opt-drop" ',
							'name="'.$name.'" value="'.$k.'" '.((in_array($k, $arr)) ? 'checked' : '').'>',
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

class RadioButtonGroup extends sfWidgetFormChoiceBase
{
		public function render($name, $value = null, $attributes = [], $errors = [])
		{
				$result = ['<div class="btn-group">'];
				$choices = $this->getChoices();
				foreach ($choices as $k => $choice) {
						$tmp = [
							'<label class="btn--flex">',
							'<input type="radio" ',
							'class="'.$attributes['class'].'" ',
							'name="'.$name.'" value="'.$k.'" '.(($value == $k) ? 'checked' : '').'>',
							'<span>'.$choice.'</span>',
							'</label>',
						];
						$result = array_merge($result, $tmp);
				}
				array_push($result, '</div>');
				return implode('', $result);
		}
}
