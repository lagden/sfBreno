<?php
namespace lagden;

use lagden\GetFile as GetFile;
use Symfony\Component\Filesystem\Filesystem;
use sfConfig as sfConfig;

class SaveFile
{
    /*

    $param - 'id' onde será gravado, 'name' Nome do campo mestre, 'lang' Ligunga, 'parent' se o id é de um parent
    $dir - diretorio onde será salvo
    $clean - Limpa o diretorio - GLOB
    $exec - Executa bashscript
    $bash - nome do script
    $unlink - remove o arquivo gerado ao finalizar
    $customName - nome customizado para o newFilename

    // */
    static public function save($param, $dir, $clean=false, $exec=false, $bash=null, $customName=false, $unlink=true)
    {
        $filesystem = new Filesystem();
        $defaultParam = array(
            'id' => null,
            'name' => null,
            'lang' => null,
            'parent' => false,
        );

        // merge param
        $resultMerge = array_merge($defaultParam, $param);

        $selfId = $resultMerge['id'];
        $selfName = $resultMerge['name'];
        $selfLang = $resultMerge['lang'];
        $parent = $resultMerge['parent'];

        $ds = DIRECTORY_SEPARATOR;
        $windows = (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN');
        $bin = sfConfig::get('sf_root_dir')."{$ds}bin{$ds}";

        // verifica se o arquivo
        if ($selfName && (!preg_match("/\//i", $selfName) || preg_match("/\.\.\/test/i", $selfName)) )
        {
            $recordDir = static::encontreNoGrupo($dir, $selfId);
            if($recordDir)
            {
                if($clean)
                  GetFile::cleanDir($recordDir, $clean);
            }
            else
            {
                $recordDir = static::encontreGrupoDisponivel("{$dir}", "{$selfId}");
                $filesystem->mkdir($recordDir, $mode = 0755);
            }

            preg_match("/[0-9a-f]{32}/i", $recordDir, $matches);
            $hash = (isset($matches[0])) ? $matches[0] : null;

            // Verifica se existe o hash
            if(!$hash)
              die('SaveFile error: Missing hash');
            else
              $dir = "{$dir}{$ds}{$hash}";

            // move the original file to the record folder
            $uploaded = GetFile::getUploadBasePath().$selfName;

            $parts = pathinfo($uploaded);
            $newExt = $parts['extension'];

            $partsExt = ($parent) ? "{$selfLang}.{$parts['extension']}" : "{$parts['extension']}";

            // Final file name
            $newFilename = ($exec) ? "original.{$partsExt}" : basename($uploaded);
            $newFilename = ($customName) ? "{$customName}.{$partsExt}" : $newFilename;
            $newLocalFile = "{$recordDir}{$ds}{$newFilename}";

            // move o arquivo para o local
            $filesystem->rename($uploaded, $newLocalFile);

            // Gera outros tamanhos - imagemagick bashscript
            $output = false;
            if($exec && $bash)
            {
                if ($windows)
                {
                    $dir = str_replace("\\", "/", $dir);
                    $dir = preg_replace("/([a-zA-Z])\:\//", "/$1/", $dir);
                    $cmd = "sh {$bin}{$bash} {$newLocalFile} {$recordDir}";
                }
                else
                    $cmd = "{$bin}{$bash} {$newLocalFile} {$recordDir}";

                $return_var = 0;
                $cmd = ($parent) ? "{$cmd} {$selfLang}": $cmd;

                $output = shell_exec("{$cmd}");

                if(!$output)
                    die("SaveFile error: {$cmd}");

                // remove o arquivo
                if($unlink && file_exists($newLocalFile))
                    unlink($newLocalFile);
            }
            return [
              'hash' => $hash,
              'id'   => $selfId,
              'ext'  => $newExt,
              'out'  => $output
            ];
        }
        return false;
    }

    static public function encontreNoGrupo($dir, $id)
    {
        $ds = DIRECTORY_SEPARATOR;
        $r = glob("{$dir}{$ds}{*}{$ds}{$id}", GLOB_ONLYDIR | GLOB_BRACE | GLOB_NOSORT);
        return isset($r[0]) ? $r[0] : null;
    }

    // estrutura de arquivos agrupado por hash - cada grupo de hash(dir) suporta até 1000 diretórios
    static private function encontreGrupoDisponivel($dir, $id)
    {
        $ds = DIRECTORY_SEPARATOR;
        $rs = glob("{$dir}{$ds}{*}", GLOB_ONLYDIR | GLOB_BRACE | GLOB_NOSORT);
        if(!empty($rs))
        {
            foreach ($rs as $r)
            {
                if(preg_match("/[0-9a-f]{32}/i", $r))
                {
                    $totalDirs = glob("{$r}{$ds}{*}", GLOB_ONLYDIR | GLOB_BRACE | GLOB_NOSORT);
                    if(count($totalDirs) < 1000)
                        return "{$r}{$ds}{$id}";
                }
            }
        }
        $hash = md5(mt_rand().time());
        return "{$dir}{$ds}{$hash}{$ds}{$id}";
    }
}
