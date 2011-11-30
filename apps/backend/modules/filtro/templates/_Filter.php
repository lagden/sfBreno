<?php
include_partial('global/filter',array(
    'filter' => $form,
    'filterForm' => sfConfig::get('route_form_filter'),
    'filterClear'=>sfConfig::get('route_form_filter_reset'),
    'filterField' => sfConfig::get('field_form_filter'),
));
