<?php 
class homeComponents extends GeneralComponents
{
    public function executeMenu(sfWebRequest $request)
    {
        $this->menus=Doctrine_Core::getTable('Section')->getSections()->execute();
    }
}
