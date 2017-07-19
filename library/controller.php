<?php
class Controller {

    protected $view;
    protected $model;
    protected $view_name;
    protected $privileges;
    protected $route;
    protected $obj_name;
    public function __construct() {
        $this->obj_name = get_class($this);
        logs('Masuk ' . $this->obj_name);
        $this->view_name = '';
        $this->view = new View();
        $this->route = $this->getUrl();
        $this->Assign('successMessage', '');
        $this->Assign('errorMessage', '');
        // logs('Load ' . get_called_class() . ' Class From [' . __CLASS__ . '] Class');
    }

    protected function getUrl() {
        if (isset($_GET['url'])) {
            $route = $_GET['url'];
            $r = get_class_methods($this->obj_name);
            $m = explode('/', $route);
            if (array_key_exists(1, $m)) {
                if (in_array($m[1], $r)) {
                    return $route;
                }
            } else {
                return $route . '/index';
            }
        }
        return;
    }

    public function index() {
        $this->Assign('content', 'This is index class index method, Method is not set yet.');
    }

    public function Assign($variable, $value) {
        $this->view->Assign($variable, $value);
    }

    public function Load_Model($name) {
        $modelName = $name;
        $this->model = new $modelName();
        logs('Create object from ' . $modelName);
    }

    public function Load_View($name) {
        if (file_exists(ROOT . DS . 'views' . DS . strtolower($name) . '.php')) {
            $this->view_name = $name;
        }
    }

    public function __destruct() {
        if (!empty($this->view_name)) {
            $this->view->Render($this->view_name);
        }
    }

}
