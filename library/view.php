<?php

/** * Handles the view functionality of our MVC framework */
class View {

	private $data = array();
	private $render = FALSE;
	public function __construct() {
		// logs('Load ' . get_called_class() . ' Class From [' . __CLASS__ . '] Class');

		$this->data['site_title'] = '';
		$this->data['site_name'] = '';
		$this->data['site_icon'] = '';
		$this->data['meta_keywords'] = '';
		$this->data['meta_description'] = '';

		$this->data['css'] = '';
		$this->data['js'] = '';

		$this->data['header'] = '';
		$this->data['content'] = '';
		$this->data['footer'] = '';
		$this->Set_Site_Title(APP_NAME.' - '.APP_TITLE);
		$this->Set_Site_Name(strtoupper(APP_NAME));
		$this->Set_Site_Icon(APP_ICON);
		$this->Set_Meta_Keywords(KEYWORDS);
		$this->Set_Meta_Description(DESCRIPTION);
	}

	public function Assign($variable = '', $value) {
		if ($variable == '')
			$this->data = $value;
		else
			$this->data[$variable] = $value;
	}

	public function Render($view, $direct_output = TRUE) {

		if(substr($view, -4) == ".php"){
			$file = $view;
		}
		else{
			$file = ROOT . DS . 'views' . DS . strtolower($view) . '.php';
		}

		if (file_exists($file)) {
/**
* trigger render to include file when this model is destroyed
* if we render it now, we wouldn't be able to assign variables
* to the view!
*/
			$this->render = $file;
		}
		else{
			return "view file doesn't exist.";
		}

// Turn output buffering on, capturing all output
		if ($direct_output !== TRUE) {
			ob_start();
		}

// Parse data variables into local variables
		$data = $this->data;

// Get template
		include($this->render);

// Get the contents of the buffer and return it
		if ($direct_output !== TRUE) {
			return ob_get_clean();
		}
	}

	public function Set_Site_Title($name){
		$this->data['site_title'] = ' ' . $name . ' ';
	}

	public function Set_Site_Name($name){
		$this->data['site_name'] = ' ' . $name . ' ';
	}

	public function Set_Site_Icon($filename){
		if (file_exists(SITE_ROOT . DS . $filename)){
			$this->data['site_icon'] = ' <link href="' . SITE_ROOT . DS . $filename . '" rel="shortcut icon" type="image/vnd.microsoft.icon" />';
		}
	}

	public function Set_Meta_Keywords($words){
		$this->data['meta_keywords'] = '<meta name="keywords" content="' . $words . '" />';
	}

	public function Set_Meta_Description($descr){
		$this->data['meta_description'] = '<meta name="description" content="' . $descr . '" />';
	}

	public function Set_CSS($filename){
		if (file_exists(ROOT . DS . $filename)){
			$this->data['css'] = $this->data['css'] . ' <link href="' . SITE_ROOT . '/' . str_replace('', '/', $filename) . '" rel="stylesheet\" type="text/css" />';
		}
	}

	public function Set_JS($filename){
		$this->data['js'] = $this->data['js'] . '<script type="text/javascript" src="' . $filename . '" language="JavaScript"></script>' . PHP_EOL; }
	}