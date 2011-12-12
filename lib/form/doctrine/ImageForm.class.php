<?php

/**
* Image form.
*
* @package    sfProject
* @subpackage form
* @author     Thiago Lagden
* @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
*/
class ImageForm extends BaseImageForm
{
    public function configure()
    {
        $this->useFields(array('file','estate_id'));

        $this->widgetSchema['estate_id'] = new sfWidgetFormInputText();
        $this->widgetSchema['file'] = new sfWidgetFormInputFile();

        // Validation
        // Default message errors
        sfValidatorBase::setDefaultMessage('required', 'Este campo é obrigatório.');
        sfValidatorBase::setDefaultMessage('invalid', 'A informação que você digitou é inválida.');

        $this->validatorSchema['file'] = new sfValidatorFile(array(
            'required' => $this->getObject()->isNew(),
            'path'=>sfConfig::get('sf_upload_dir'),
        ));
    }
}
