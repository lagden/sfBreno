<?php
/**
* Lista
*/
class Lista
{
	static public function svgLista()
	{
		return [
			['svg'=> '#custom_suite', 'field'=> 'suites', 'title'=> 'Suítes', 'sufix'=> ''],
			['svg'=> '#custom_quarto', 'field'=> 'quartos', 'title'=> 'Quartos', 'sufix'=> ''],
			['svg'=> '#custom_banheiro', 'field'=> 'banheiros', 'title'=> 'Banheiros', 'sufix'=> ''],
			['svg'=> '#custom_vaga', 'field'=> 'vagas', 'title'=> 'Vagas para veículos', 'sufix'=> ''],
			['svg'=> '#custom_metro', 'field'=> 'area_util', 'title'=> 'Área útil', 'sufix'=> 'm²']
		];
	}
}
