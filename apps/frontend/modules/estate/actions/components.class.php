<?php
class estateComponents extends GeneralComponents
{
		public function executeFilter(sfWebRequest $request)
		{
				$this->consultaItem = [
					['svg'=>'#custom_valor'    , 'field'=>['valor','valor_max'] , 'css'=>'opts--min'],
					['svg'=>'#custom_suite'    , 'field'=>'suites'                  , 'css'=>null],
					['svg'=>'#custom_quarto'   , 'field'=>'quartos'                 , 'css'=>null],
					['svg'=>'#custom_banheiro' , 'field'=>'banheiros'               , 'css'=>null],
					['svg'=>'#custom_metro'    , 'field'=>['area','area_max']   , 'css'=>'opts--min'],
					['svg'=>'#custom_vaga'     , 'field'=>'vagas'                   , 'css'=>null],
				];
				$this->form=new EstateFormFilter(Filter::get());
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
					['sorting' => sfContext::getInstance()->getUser()->getAttribute(sfConfig::get('order_by'),false)],
					['sorting_values' => Doctrine_Core::getTable('Estate')->getSorting()]
				);
		}
}
