<?php
include_partial('global/slider', ['destaques' => $destaques]);
include_component('estate', 'Filter');
foreach($estates as $estate) {
	include_partial('global/list_estate', ['estate' => $estate]);
}
