<?php
set_time_limit(0);
class lagdenBannerTask extends sfBaseTask
{
    protected function configure()
    {

        $this->namespace        = 'lagden';
        $this->name             = 'banner';
        $this->briefDescription = 'Geras as imagens para o tamanho do banner';
        $this->detailedDescription = <<<EOF
The [lagden:image|INFO] task does things.
Call it with:

    [php symfony lagden:image|INFO]
EOF;
    }

    protected function execute($arguments = array(), $options = array())
    {

        gc_enabled();
        
        $ds=DIRECTORY_SEPARATOR;
        $webdir=sfConfig::get('sf_web_dir');
        $dir="{$webdir}{$ds}estates";
        $bin=sfConfig::get('sf_root_dir')."{$ds}bin{$ds}";

        chdir($dir);
        

        $dirs = glob("*",GLOB_ONLYDIR);
        if($dirs)
        {
            foreach ($dirs as $currDir)
            {
                $fulldir="{$dir}{$ds}{$currDir}{$ds}";
                $original = glob("{$fulldir}{original.*}",GLOB_BRACE);
                if($original)
                {
                    foreach ($original as $o)
                    {
                        if(file_exists($o))
                        {
                            $out = array();
                            exec("{$bin}banner.sh {$currDir}",$out);
                            print_r($out);
                        }
                    }
                }
                // if(is_dir($currDir))
                // {
                //     if(file_exists("{$dir}{$ds}{$currDir}{$ds}{original.*"))
                //     {
                //         echo "nice";
                //     } else echo "nono";
                //     
                // }
            }
        }
        // if($itens)
        // {
        //     $total = count($itens);
        //     $cc=1;
        //     foreach($itens as $item)
        //     {
        //         if(is_file($item))
        //         {
        //             $file = "..{$ds}{$ref}" . basename($item);
        //             try
        //             {
        //                 $image = new Image();
        //                 $image->file = $file;
        //                 $image->estate_id = $options['id'];
        //                 if($options['update']==0)$image->destaque = ($cc==$total) ? 1 : 0;
        //                 $image->external = 1;
        //                 $image->save();
        //                 $image->free(true);
        //                 $image = null;
        //                 file_put_contents("{$tmp}carga.log","[".date('c')."][image] Gravado: {$file}. \n",FILE_APPEND);
        //             }
        //             catch (Exception $e)
        //             {
        //                 file_put_contents("{$tmp}carga.log","[".date('c')."][image] Falha ao gravar: {$file}. \n",FILE_APPEND);
        //             }
        //             $file=null;
        //         }
        //         $cc++;
        //     }
        // }
        // $ds=null;
        // $total=null;
        // $cc=null;
        // $webdir=null;
        // $ref=null;
        // $dir=null;
        // $itens=null;
        gc_collect_cycles();
        die;
    }
}