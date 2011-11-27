<?php 
class GeneralComponents extends sfComponents
{
    public function executeFilter(sfWebRequest $request)
    {
        $this->form=Filter::execute();
    }
}
