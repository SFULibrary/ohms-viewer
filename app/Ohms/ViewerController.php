<?php namespace Ohms;

use Exception;
use Ohms\Interview;

class ViewerController
{
    private $interview;
    private $interviewName;
    private $tmpDir;
    private $config;
	
    public function __construct($interviewName, $xmlcontent = null, $config = null)
    {
        if($config === null) {
            $this->config = parse_ini_file("config/config.ini", true);        
        } else {
            $this->config = $config;
        }
        $this->interview = Interview::getInstance($this->config, $this->config['tmpDir'], $interviewName, $xmlcontent);
        $this->interviewName = $interviewName;
    }

    public function route($action, $kw, $interviewName, $tmpl)
    {
        switch($action) {
            case 'metadata':
                header('Content-type: application/json');
                echo $this->interview->toJSON();
                break;
            case 'xml':
                header('Content-type: application/xml');
                echo $this->interview->toXML();
                break;
            case 'transcript':
                echo $this->interview->getTranscript();
                break;
            case 'search':
                if (isset($kw)) {
                    echo $this->interview->Transcript->keywordSearch($kw);
                }
                break;
            case 'index':
                if (isset($kw)) {
                    echo $this->interview->Transcript->indexSearch($kw);
                }
                break;
            case 'all':
                break;
            default:
                $interview = $this->interview;
                $interviewName = $this->interviewName;
                $config = $this->config;
                $fileName = dirname(dirname(dirname(__FILE__))) . '/tmpl/' . $tmpl . '.tmpl.php';
				if(file_exists($fileName)) {
					include_once($fileName);
				} else {
					throw new Exception("Cannot display template {$tmpl} - not found.");
				}
                break;
        }
    }
}
