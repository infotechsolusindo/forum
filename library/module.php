<?php

/** * Handles the module functionality of our MVC framework */
class Module {
	private $data = array();
	private $render = FALSE;
	private $moduleitems = array();
	
	public function __construct($moduleitems = array()) {
		$this->moduleitems = $moduleitems;
		foreach ($moduleitems as $module) {
			$arr = explode('_', $module);
			$_separator = '_';
			if (count($arr) == 1) {
				$arr = explode('-', $module);
				$_separator = '-';
			}
			$module = '';
			foreach ($arr as $m) {
				$module .= ucfirst($m);
			}
			$obj = new $module;
			$this->data[strtolower(implode($_separator,$arr))] = $obj;
			if(isset($_GET['mod'])){
				$parm = explode('/',$_GET['mod']);
				$mod_name = $parm[0];
				$mod_method = $parm[1];
				$mod_value = $parm[2];
				if(strtolower($module) == $mod_name){
					$obj->$mod_method($mod_value);
				}
			}
		}
	}

	public function Render() {
		ob_start();
		if (count($this->moduleitems)>0){
			foreach ($this->moduleitems as $module) {
				$file = MODULE . strtolower($module) . DS . 'index.php';
				if (file_exists($file)){
					$this->render = $file;
				} else {
					return "module file doesn't exist.";
				}

		// Parse data variables into local variables
				$data = $this->data[strtolower($module)];

		// Get template
				include($this->render);

			}
		}
		return ob_get_clean();
	}

}