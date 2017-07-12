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
            if (isset($_GET['mod'])) {
                $parm = explode('/', $_GET['mod']);
                $mod_name = $parm[0];
                $mod_method = $parm[1];
                if (isset($parm[2])) {
                    $mod_value[] = $parm[2];
                }
                if (isset($parm[3])) {
                    $mod_value[] = $parm[3];
                }
                if (strtolower($module) == $mod_name) {
                    if (count($mod_value) == 0) {
                        $obj->$mod_method();
                    }
                    if (count($mod_value) == 1) {
                        $obj->$mod_method($mod_value[0]);
                    }
                    if (count($mod_value) == 2) {
                        $obj->$mod_method($mod_value[0], $mod_value[1]);
                    }
                }
            }
            $this->data[strtolower(implode($_separator, $arr))] = $obj;
        }
    }

    public function Render($view = 'index') {
        ob_start();
        if (count($this->moduleitems) > 0) {
            foreach ($this->moduleitems as $module) {
                $file = MODULE . strtolower($module) . DS . $view . '.php';
                if (file_exists($file)) {
                    $this->render = $file;
                } else {
                    return "module file doesn't exist.";
                }

                // Parse data variables into local variables
                if (isset($this->data[strtolower($module)]->disable)) {
                    if (!$this->data[strtolower($module)]->disable) {
                        $data = $this->data[strtolower($module)];
                        // Get template
                        include $this->render;
                    }
                } else {
                    $data = $this->data[strtolower($module)];
                    // Get template
                    include $this->render;

                }

            }
        }
        return ob_get_clean();
    }

}