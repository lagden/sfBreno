<?php
class sfWidgetFormChoiceCustom extends sfWidgetFormChoice
{
		public function getRenderer()
		{
				if ($this->getOption('renderer'))
				{
						return $this->getOption('renderer');
				}

				if (!$class = $this->getOption('renderer_class'))
				{
						$type = !$this->getOption('expanded') ? '' : ($this->getOption('multiple') ? 'checkboxCustom' : 'radio');
						$class = sprintf('sfWidgetFormSelect%s', ucfirst($type));
				}

				$options = $this->options['renderer_options'];
				$options['choices'] = new sfCallable([$this, 'getChoices']);

				$renderer = new $class($options, $this->getAttributes());

				if ($renderer->hasOption('translate_choices')) {
						$renderer->setOption('translate_choices', false);
				}

				$renderer->setParent($this->getParent());

				return $renderer;
		}
}
