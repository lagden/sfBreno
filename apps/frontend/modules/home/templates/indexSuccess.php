<?php
include_partial('global/slider', ['destaques' => $destaques]);
include_component('estate', 'Filter');
include_partial('global/list_estate', ['estates' => $estates]);
