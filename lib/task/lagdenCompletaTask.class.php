<?php
set_time_limit(0);
class lagdenCompletaTask extends sfBaseTask
{
    protected function configure()
    {
        $this->addOptions(array(
            new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name', 'frontend'),
            new sfCommandOption('env', null, sfCommandOption::PARAMETER_OPTIONAL, 'The environment', 'dev'),
            new sfCommandOption('connection', null, sfCommandOption::PARAMETER_OPTIONAL, 'The connection name', 'doctrine'),
        ));
        $this->namespace        = 'lagden';
        $this->name             = 'completa';
        $this->briefDescription = 'Dispara email quando a carga é finalizada';
        $this->detailedDescription = <<<EOF
The [lagden:ftp|INFO] task does things.
Call it with:
    [php symfony lagden:ftp|INFO]
EOF;
    }
    
    protected function execute($arguments = array(), $options = array())
    {
        $info = sfConfig::get('app_footer');
        $message = $this->getMailer()->compose();
        $message->setSubject("{$info['site']} [Carga] [".date("YmdHis")."]");
        $message->setTo(sfConfig::get('app_send_to'));
        $message->setFrom(sfConfig::get('app_master_email'), "Carga");
        $html = $this->emailHtml('_email_carga.php');
        $message->setBody($html, 'text/html');
        $this->getMailer()->send($message);
    }
    
    private function emailHtml($param)
    {
        $ds=DIRECTORY_SEPARATOR;
        $rootdir=sfConfig::get('sf_root_dir');
        $tmp="{$rootdir}{$ds}tmp{$ds}";
        
        $log = false;
        if(is_file("{$tmp}carga.log"))$log = file_get_contents("{$tmp}carga.log");
        
        $template = sfConfig::get('sf_app_template_dir')."/{$param}";
        ob_start();
        require($template);
        $_content = ob_get_contents();
        ob_clean();
        return $_content;
    }
}