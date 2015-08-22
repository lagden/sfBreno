<?php
class Helper
{
    const REGEX_DATE = '/^(0?[1-9]|[12][0-9]|3[01])[\-\s\/\.](0?[1-9]|1[012])[\-\s\/\.](\d{4})$/';
    const REGEX_URL = '/http(s)?:\/\/[(www\.)?a-zA-Z0-9\@\:\%\.\_\+\~\#\=]{2,256}\.[a-z]{2,6}\b([\-a-zA-Z0-9\@\:\%\_\+\.\~\#\?\&\/\/\=]*)/i';

    static public function ajaxBug()
    {
        $context = sfContext::getInstance();
        $user = $context->getUser();
        $attribs = isset($_SESSION['symfony/user/sfUser/attributes']['symfony/user/sfUser/attributes']) ? $_SESSION['symfony/user/sfUser/attributes']['symfony/user/sfUser/attributes'] : [];
        $user->shutdown();
        foreach ($attribs as $key => $value) {
          $user->setAttribute($key, $value);
        }
    }

    static public function fileExists($file)
    {
        return file_exists($file);
    }

    static public function getToken()
    {
        $context = sfContext::getInstance();
        $user = $context->getUser();
        return $user->getAttribute(sfConfig::get('app_frm'), false);
    }

    // Retorna true se a cotação é válida
    static public function isValid()
    {
      $token = static::getToken();
      if(!$token) {
        return false;
      }

      // Procura o registro
      $tbl = CotacaoTable::getInstance();
      $r = $tbl->getByField([
          'token' => $token,
          'cliente' => COD_CLI,
          'ev' => COD_EV
        ], $tbl->getByOrderAndLimit('DESC', 'created_at', 1))
        ->fetchOne();

      return $r;
    }

    static public function getDataYML($path, $file)
    {
        $ds = DIRECTORY_SEPARATOR;
        $dir = sfConfig::get('sf_data_dir');
        $yml = "{$dir}{$ds}{$path}{$ds}{$file}";
        return (file_exists($yml)) ? sfYaml::load($yml) : false;
    }

    static public function setDataYML($file, $data)
    {
        $ds = DIRECTORY_SEPARATOR;
        $dir = sfConfig::get('sf_data_dir');
        $baseFile = "{$dir}{$ds}tex{$ds}{$file}";
        return file_put_contents($baseFile, sfYaml::dump($data), LOCK_EX);
    }

    // Default response Ajax Json
    static public function response()
    {
        return [
            'success' => false,
            'msg' => 'Erro',
            'data' => [],
        ];
    }

    // Helper para api dos correios
    static public function cep($cep, $assoc = false)
    {
        $cep = implode("", explode("-", $cep));

        $api = "http://api-cep.herokuapp.com/cep/{$cep}";
        // $api = "http://cep.correiocontrol.com.br/{$cep}.json";

        $header = join([
            "Accept: application/json",
            "Accept-Encoding: gzip,deflate,sdch",
            "Accept-language: en-US",
            "Cache-Control: no-cache"
        ], "\r\n");
        $opts = [
            'http'=>[
                'method'=>"GET",
                'header'=>"{$header}"
            ]
        ];
        $context = stream_context_create($opts);
        $response = file_get_contents($api, FILE_TEXT, $context);
        return static::jsonp_decode($response, $assoc);
    }

    // JSONP
    static public function jsonp_decode($jsonp, $assoc = false)
    {
        if ($jsonp[0] !== '[' && $jsonp[0] !== '{')
            $jsonp = substr($jsonp, strpos($jsonp, '('));

        return json_decode(trim($jsonp,'();'), $assoc);
    }

    // Check if string is a JSON
    static public function isJson($s, $array = true)
    {
        $isJson = false;
        $parse = json_decode($s, $array);
        switch (json_last_error())
        {
            case JSON_ERROR_NONE:
                $isJson = true;
            break;
            case JSON_ERROR_DEPTH:
            case JSON_ERROR_STATE_MISMATCH:
            case JSON_ERROR_CTRL_CHAR:
            case JSON_ERROR_SYNTAX:
            case JSON_ERROR_UTF8:
            default:
                $isJson = false;
            break;
        }

        return $isJson ? $parse : false;
    }

    // Ping
    static public function ping($domain, $port = 80)
    {
        return gethostbynamel($domain);
    }

    static public function getTitle($v=null)
    {
        $title = sfConfig::get('app_title', false);
        if($v)
            $title = "$v - $title";
        return $title;
    }

    // parte de um template
    static public function get_partial($templateName, $vars = array(), $theFolder = null)
    {
        $context = sfContext::getInstance();

        // partial is in another module?
        if (false !== $sep = strpos($templateName, '/'))
        {
            $moduleName   = substr($templateName, 0, $sep);
            $templateName = substr($templateName, $sep + 1);
        }
        else
            $moduleName = $context->getActionStack()->getLastEntry()->getModuleName();

        $actionName = (($theFolder) ? $theFolder . DIRECTORY_SEPARATOR : "") . '_'.$templateName;

        $class = sfConfig::get('mod_'.strtolower($moduleName).'_partial_view_class', 'sf').'PartialView';
        $view = new $class($context, $moduleName, $actionName, '');
        $view->setPartialVars(true === sfConfig::get('sf_escaping_strategy') ? sfOutputEscaper::unescape($vars) : $vars);

        return $view->render();
    }

    // Formata datas
    static public function date($date, $format='d/m/Y')
    {
        if($date)
        {
            try
            {
                $d = new DateTime($date);
                return $d->format($format);
            }
            catch (Exception $e)
            {
                return null;
            }
        }
        else return null;
    }

    // de 31/12/2007 | 31-12-2007 para 2007-12-31
    static public function toMysql($date)
    {
        preg_match(self::REGEX_DATE, $date, $matches);
        if(count($matches))
        {
            return "{$matches[3]}-{$matches[2]}-{$matches[1]}";
        }
        return null;
    }

    // parse date
    static public function parseDate()
    {
        $param = null;
        $n = func_num_args();
        if($n === 3)
        {
            $param = [];
            $param['d'] = func_get_arg(0);
            $param['m'] = func_get_arg(1);
            $param['y'] = func_get_arg(3);
        }
        elseif ($n === 1)
        {
            if(is_string(func_get_arg(0)))
            {
                preg_match(self::REGEX_DATE, func_get_arg(0), $matches);
                if(count($matches) === 4)
                {
                    $param = [];
                    $param['d'] = $matches[1];
                    $param['m'] = $matches[2];
                    $param['y'] = $matches[3];
                }
            }
        }

        return $param;
    }

    // $string 31/12/2007 || 31-12-2007
    // $day, $month, $year
    static public function age()
    {
        $n = func_num_args();
        if($n === 1 && is_array(func_get_arg(0)))
            $param = static::parseDate(implode('/', func_get_arg(0)));
        else
            $param = static::parseDate(implode('/', func_get_args()));

        if(!is_array($param))
            return null;

        $current = [];
        $current['d'] = gmstrftime("%d");
        $current['m'] = gmstrftime("%m");
        $current['y'] = gmstrftime("%Y");

        return static::diffAges($current, $param);
    }

    static public function diffAges($a, $b) {
        $age = $a['y'] - $b['y'];
        $month = $a['m'] - $b['m'];
        if ($month < 0 || ($month === 0 && $a['d'] < $b['d']))
            $age--;
        return intval($age);
    }

    static public function fixCEP($cep)
    {
        $cep = explode("-", $cep);
        if(is_array($cep))
            $cep = implode("", $cep);

        return $cep;
    }

    static public function sendEmail($data, $subject = '')
    {
        $transport = Swift_SmtpTransport::newInstance()
            ->setHost('smtp.webfaction.com')
            ->setPort(465)
            ->setEncryption('ssl')
            ->setUsername('lagden')
            ->setPassword('surftrip123');

        $mailer = Swift_Mailer::newInstance($transport);
        $html = static::get_partial('global/debug', ['data' => $data]);
        $message = Swift_Message::newInstance();
        $message->setSubject("[Nimble DEBUG] {$subject}");
        $message->setTo(['lagden@teleportweb.com.br', 'veronese@teleportweb.com.br']);
        $message->setFrom(['no-reply@lagden.in']);
        $message->setBody($html, 'text/html');
        return $mailer->send($message);
    }
}
