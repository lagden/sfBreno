<?php
/**
* Lista
*/
class Lista
{
	static public function svgLista()
	{
		return [
			['svg'=> '#custom_quarto', 'field'=> 'quartos', 'title'=> 'Quarto', 'sufix'=> ''],
			['svg'=> '#custom_suite', 'field'=> 'suites', 'title'=> 'Suíte', 'sufix'=> ''],
			['svg'=> '#custom_banheiro', 'field'=> 'banheiros', 'title'=> 'Banheiro', 'sufix'=> ''],
			['svg'=> '#custom_vaga', 'field'=> 'vagas', 'title'=> 'Vaga', 'sufix'=> ''],
			['svg'=> '#custom_metro', 'field'=> 'area_util', 'title'=> 'Área útil', 'sufix'=> 'm²']
		];
	}
}
