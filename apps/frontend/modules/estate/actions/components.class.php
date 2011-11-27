<?php 
class estateComponents extends GeneralComponents
{
    public function executeFilter(sfWebRequest $request)
    {
        sfConfig::set("formFilter",sfConfig::get("app_formfilter_estate","EstateFormFilter"));
        $this->form=Filter::execute();
    }
}
