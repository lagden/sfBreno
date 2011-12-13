<?php
class GetFile
{
    static public function find($dir,$default)
    {
        $file = glob($dir);
        if(count($file) > 0)$find = basename($file[0]);
        else $find = $default;

        return $find;
    }

    static public function read($path,$file)
    {
        if(is_dir($path)) return static::readFile($path.$file);
        return false;
    }

    static public function readFile($file)
    {
        if(file_exists($file)){
            $handle=fopen($file,"r");
            $content=fread($handle,filesize($file));
            fclose($handle);
            return $content;
        }
        return false;
    }

    static public function write($path,$file,$content,$mode='w+')
    {
        if(!is_dir($path))mkdir($path,0775,true);
        $handle=fopen($path.$file,$mode);
        if(flock($handle, LOCK_EX))
        {
            ftruncate($handle, 0);
            fwrite($handle,$content);
            flock($handle, LOCK_UN);
        }
        fclose($handle);
    }

    static public function dir()
    {
        $ds=DIRECTORY_SEPARATOR;
        return sfConfig::get('sf_data_dir')."{$ds}files{$ds}";
    }

    static public function showfile($file)
    {
        $pathFile=self::dir().$file;
        $content=GetFile::readFile($pathFile);
        return $content;
    }

    static public function getMime($file)
    {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $file);
        finfo_close($finfo);
        return $mime;
    }

    // Limpa o diretorio
    static public function cleanDir($recordDir,$clean='{*}')
    {
        if(is_dir($recordDir)==false)return false;

        $itens = glob("{$recordDir}{$clean}",GLOB_BRACE);
        if($itens)
        {
            foreach($itens as $item)
            {
                if(is_file($item))
                {
                    @unlink($item);
                }
            }
        }
    }

    // gera o nome do arquivo
    static public function generateFilename($validator)
    {
        $ds=DIRECTORY_SEPARATOR;
        $file=$validator->getOriginalName();
        $ext=$validator->getOriginalExtension();
        $base=Doctrine_Inflector::urlize(basename($file,$ext));
        $rnd=mt_rand();
        return "{$base}_{$rnd}{$ext}";
    }

    // path web/upload/
    static public function getUploadBasePath()
    {
        $ds=DIRECTORY_SEPARATOR;
        return sfConfig::get('sf_upload_dir')."{$ds}";
    }
}
