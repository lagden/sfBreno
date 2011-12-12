<?php

/**
* Image form.
*
* @package    ImageBank
* @subpackage form
* @author     Felds Liscia <dev@felds.com.br>
* @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
*/
class ImageChunkForm extends BaseImageForm
{
    public function configure()
    {
        ($this->getObject()->isNew()) ? $this->useFields(array('file','estate_id')) : $this->useFields(array('file'));
        
        $this->widgetSchema['estate_id'] = new sfWidgetFormInputText();
        $this->widgetSchema['file'] = new sfWidgetFormInputText();
        
        // Validation
        // Default message errors
        $this->validatorSchema['estate_id'] = new sfValidatorString(array('required' => false));
        $this->validatorSchema['file'] = new sfValidatorString(array('required' => false));
    }
}
