<?php
class sfWidgetFormSelectCheckboxCustom extends sfWidgetFormSelectCheckbox
{
		protected $attributes = [];
		protected function formatChoices($name, $value, $choices, $attributes)
		{
				$this->attributes = [];
				$inputs = [];

				$class = [];
				if (isset($attributes['class']))
				{
						$class['class'] = $attributes['class'];
						unset($attributes['class']);
				}
				else
						$class['class'] = null;

				$counter = 1;
				$total = count($choices);

				foreach ($choices as $key => $option)
				{
						$baseAttributes = [
								'name'  => $name,
								'type'  => 'checkbox',
								'value' => self::escapeOnce($key),
								'id'    => $id = $this->generateId($name, self::escapeOnce($key)),
						];

						if ((is_array($value) && in_array(strval($key), $value)) || (is_string($value) && strval($key) == strval($value))) {
								$baseAttributes['checked'] = 'checked';
						}

						if($counter == $total) {
							$attributes = array_merge($attributes, $class);
						}

						$inputs[$id] = [
								'input' => $this->renderTag('input', array_merge($baseAttributes, $attributes)),
								'label' => $this->renderContentTag('label', self::escapeOnce($option), array('for' => $id)),
						];

						$counter++;
				}

				return call_user_func($this->getOption('formatter'), $this, $inputs);
		}
}
