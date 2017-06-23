<?php
require_once('lib/nusoap.php');
error_reporting(0);

class mysoap extends nusoap_client
{
	public $endpoint;
	public $mode;
	public $context;
	public $namespace;
	public $soapFunction;

	public $username;
	public $password;

	public $debug;

	// public function __construct(){
	// 	$this->debug = MYSOAP_DEBUG;
	// }

	public function setHeader($data=[]){
		if(empty($data)){}

		$header = '<HEADER>';

		foreach ($data as $key => $value) {
			$tag = strtoupper($key);
			$header .= '<'.$tag.'>'.$value.'</'.$tag.'>';
		}

		$header .= '</HEADER>';
		$this->header = $header;
	}

	public function setDetail($data=[]){
		$context = strtoupper($this->context);

		if(empty($data)){ return false;}

		$detail  = '<DETIL>';
		$detail .= '<'.$context.'>';
		foreach ($data as $key => $value) {
			$tag = strtoupper($key);
			$detail .= '<'.$tag.'>'.$value.'</'.$tag.'>';
		}
		$detail .= '</'.$context.'>';
		$detail .= '</DETIL>';

		$this->detail = $detail;
	}

	public function generateXML(){
		$xmlstart  = '<?xml version="1.0" encoding="utf-8"?>';
		$xmlstart .= '<DOCUMENT xmlns="cocokms.xsd">';
		$xmlstart .= '<COCOKMS>';

		$xmldata = $this->header;
		$xmldata .= $this->detail;

		$xmlend  = '</COCOKMS>';
		$xmlend .= '</DOCUMENT>';

		return $xmlstart.$xmldata.$xmlend;
	}

	public function exec(){
		$xml = $this->generateXML();
		// echo $xml;

		// $error  = $this->getError();
		// if ($error) {
		//     echo '<h2>Constructor error</h2><pre>' . $error . '</pre>';
		// } else {
		//     echo 'Successfull connection';
		// }

		// echo $this->namespace;
		$result = $this->call(
			$this->soapFunction,
			[
				'Username'=>$this->username,
				'Password'=>$this->password,
				'fStream'=>$xml
			],
			$this->namespace,
			$this->namespace.$this->soapFunction
		);
		if ($this->fault) {
		    echo '<h2>Fault</h2><pre>';
		    var_dump($result);
		    echo '</pre>';
		} else {
		    $error = $this->getError();
		    if ($error) {
		        echo '<h2>Error</h2><pre>' . $error . '</pre>';
		    } else {
		        // echo '<h2>Main</h2><pre>';
		        // var_dump($result);
		        // echo '</pre>';
		    }
		}

			// logs('Debug:'.$this->getDebug());
		if(MYSOAP_DEBUG){
			echo '<h2></h2><textarea width="100%"><pre>';
			var_dump($this->getDebug());
			echo '</pre></textarea>';
		}
		$output = (Object) [
			'result'=>$result,
			'error'=>$error
		];

		return $output;
		echo '<pre>' . htmlspecialchars($this->request, ENT_QUOTES) . '</pre>';
		// echo '<pre>' . htmlspecialchars($this->getDebug(), ENT_QUOTES) . '</pre>';
	}
}