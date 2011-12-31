<?php
set_time_limit(0);
class lagdenCargaTask extends sfBaseTask
{
    protected function configure()
    {
        $this->namespace        = 'lagden';
        $this->name             = 'carga';
        $this->briefDescription = 'Faz a carga dos dados baixados via FTP';
        $this->detailedDescription = <<<EOF
The [lagden:flickr|INFO] task does things.
Call it with:

    [php symfony lagden:flickr|INFO]
EOF;
    }
    
    protected function execute($arguments = array(), $options = array())
    {
        $ds=DIRECTORY_SEPARATOR;
        $rootdir=sfConfig::get('sf_root_dir');
        $tmp="{$rootdir}{$ds}tmp{$ds}";
        
        // Vai para o diretório root/
        chdir($rootdir);
        
        if(is_file("{$tmp}carga.yml"))
        {
            $carga = sfYaml::load("{$tmp}carga.yml");
            foreach ($carga as $v)
            {
                gc_enabled();
                exec('./symfony lagden:acao --dados="'. base64_encode(serialize($v)) .'"',$out);
                print_r($out); echo "\n";
                echo "Mem usage is: ", memory_get_usage(), "\n";
                $out = null;
                $v = null;
                gc_collect_cycles();
            }
            gc_disable();
            echo "Carga finalizada. \n";die;
        }
        else
        {
            die("Não há arquivo de carga. \n");
        }
    }
}