<?php 
class estateComponents extends sfComponents
{
    // public function executeSorting(sfWebRequest $request)
    // {
    //     $getUser=sfContext::getInstance()->getUser();
    //     $this->form = new ImageSortingFormFilter(array(
    //         'sorting' => $getUser->getAttribute('estate.sorting', sfConfig::get('app_estate_sorting')),
    //     ));
    // }
    
    public function executeFilter(sfWebRequest $request)
    {
        $getUser=sfContext::getInstance()->getUser();
        $filters = (array) $getUser->getAttribute('estate.filters');
        $this->form = new EstateFormFilter($filters);
    }
}