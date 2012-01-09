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
                file_put_contents("{$tmp}carga.log","[".date('c')."][carga] Reference: {$v['referencia']}. \n",FILE_APPEND);
                exec('./symfony lagden:acao --dados="'. base64_encode(serialize($v)) .'"',$out);
                file_put_contents("{$tmp}carga.log","[".date('c')."][carga] Mem usage is: ". memory_get_usage() ." \n",FILE_APPEND);
                file_put_contents("{$tmp}carga.log","[".date('c')."][carga] Atual finalizada. ({$v['referencia']}) \n",FILE_APPEND);
                $out = null;
                $v = null;
                gc_collect_cycles();
            }
            gc_disable();
            file_put_contents("{$tmp}carga.log","[".date('c')."][carga] Carga finalizada. \n",FILE_APPEND);
            die;
        }
        else
        {
            file_put_contents("{$tmp}carga.log","[".date('c')."][carga] Não há arquivo de carga. \n",FILE_APPEND);
            die;
        }
    }
}