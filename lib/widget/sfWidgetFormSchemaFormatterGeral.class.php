<?php
class sfWidgetFormSchemaFormatterGeral extends sfWidgetFormSchemaFormatter
{
    protected $rowFormat = '<div class="form_row%row_class%">%error% %label% %field% %help% %hidden_fields%</div>';
    protected $helpFormat = '<div class="form_help">%help%</div>';
    protected $decoratorFormat = '<div>%content%</div>';

    public function formatRow($label, $field, $errors = array(), $help = '', $hiddenFields = null)
    {
        $row = parent::formatRow(
            $label,
            $field,
            $errors,
            $help,
            $hiddenFields
        );

        return strtr($row, array('%row_class%' => (count($errors) > 0) ? ' error' : ''));
    }
}