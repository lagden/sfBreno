<?php
class Tags
{
    /**
    *
    * @return integer
    * @author Thiago Lagden
    */
    public static function modelo($m,$id)
    {
        $obj = Doctrine_Core::getTable($m)->find($id);
        $tagArray = array();
        foreach($obj->Tags as $tag)
        {
            $tagArray[]=$tag->name;
        }
        return json_encode($tagArray);
    }

    public static function lista()
    {
        $tags = Doctrine_Core::getTable('Tag')->findAll();
        $tagArray = array();
        foreach($tags as $tag)
        {
            $tagArray[]=$tag->name;
        }
        return json_encode($tagArray);
    }
}