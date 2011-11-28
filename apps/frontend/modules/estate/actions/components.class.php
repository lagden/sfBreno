<?php 
class estateComponents extends GeneralComponents
{
    public function executeFilter(sfWebRequest $request)
    {
        // sfConfig::set("formFilter",sfConfig::get("app_formfilter_estate","EstateFormFilter"));
        // $this->form=Filter::execute();
        
        $this->form=new EstateFormFilter();
    }

    public function executeReferencia(sfWebRequest $request)
    {
        $this->form=new ReferenciaForm();
    }
    
    public function executeContato(sfWebRequest $request)
    {
        $this->form=new ContatoForm();
    }
    
    public function executeSorting(sfWebRequest $request)
    {
        $this->form=new SortingForm(
            array(
                'sorting' => sfContext::getInstance()->getUser()->getAttribute(sfConfig::get('order_by'),false),
            ),array(
                'sorting_values' => Doctrine_Core::getTable('Estate')->getSorting(),
            )
        );
    }
}
