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
            }
        }
        gc_collect_cycles();
        die;
    }
}