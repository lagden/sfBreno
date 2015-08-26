<?php
class fixWidgetFormInputCheckbox extends sfWidgetFormInputCheckbox
{
		/**
		* OVERRIDE RENDER METHOD DUE TO SYMFONY BUG (HTTP://TRAC.SYMFONY-PROJECT.ORG/TICKET/3917)
		*/
		public function render($name, $value = null, $attributes = array(), $errors = array())
		{
				if (!is_null($value) && $value !== false && $value != 0)
				{
						$attributes['checked'] = 'checked';
				}
				if (!isset($attributes['value']) && !is_null($this->getOption('value_attribute_value')))
				{
						$attributes['value'] = $this->getOption('value_attribute_value');
				}
				return parent::render($name, null, $attributes, $errors);
		}
}
