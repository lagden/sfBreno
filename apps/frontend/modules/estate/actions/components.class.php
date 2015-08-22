<?php
class estateComponents extends GeneralComponents
{
    public function executeFilter(sfWebRequest $request)
    {
    		$this->consultaItem = [
    			['svg'=>'#custom_valor', 'field'=>'valor', 'css'=>'opts--min'],
    			['svg'=>'#custom_suite', 'field'=>'suites', 'css'=>null],
    			['svg'=>'#custom_quarto', 'field'=>'quartos', 'css'=>null],
    			['svg'=>'#custom_banheiro', 'field'=>'banheiros', 'css'=>null],
    			['svg'=>'#custom_metro', 'field'=>'area_util', 'css'=>'opts--min'],
    			['svg'=>'#custom_vaga', 'field'=>'vagas', 'css'=>null],
    		];
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
