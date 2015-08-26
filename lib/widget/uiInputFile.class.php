<?php
class uiInputFile extends sfWidgetFormInputFile
{
    protected function configure($options = array(), $attributes = array())
    {
        parent::configure($options, $attributes);

        $this->setOption('type', 'file');
        $this->setOption('needs_multipart', true);

        $this->addRequiredOption('file_src');
        $this->addOption('is_image', false);
        $this->addOption('edit_mode', true);
        $this->addOption('with_delete', true);
        $this->addOption('delete_label', 'remove the current file');
        $this->addOption('template', '%file%<br>%input%<br>%delete% %delete_label%');
    }

    public function render($name, $value = null, $attributes = array(), $errors = array())
    {
        $input = parent::render($name, $value, $attributes, $errors);

        if (!$this->getOption('edit_mode'))
        {
            return $input;
        }

        if ($this->getOption('with_delete'))
        {
            $deleteName = ']' == substr($name, -1) ? substr($name, 0, -1).'_delete]' : $name.'_delete';

            $delete = $this->renderTag('input', array_merge(array('type' => 'checkbox', 'name' => $deleteName), $attributes));
            $deleteLabel = $this->translate($this->getOption('delete_label'));
            // $deleteLabel = $this->renderContentTag('label', $deleteLabel, array_merge(array('for' => $this->generateId($deleteName))));
        }
        else
        {
            $delete = '';
            $deleteLabel = '';
        }
        
        return strtr($this->getOption('template'), array('%input%' => $input, '%delete%' => $delete, '%delete_label%' => $deleteLabel, '%file%' => $this->getFileAsTag($attributes)));
    }

    protected function getFileAsTag($attributes)
    {
        if ($this->getOption('is_image'))
        {
            return false !== $this->getOption('file_src') ? $this->renderTag('img', array_merge(array('src' => $this->getOption('file_src')), $attributes)) : '';
        }
        else
        {
            return $this->getOption('file_src');
            // return null;
        }
    }
}