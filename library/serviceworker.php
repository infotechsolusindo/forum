<?php
class ServiceWorker {
    private $done;
    public $name;
    public $data;
    private $action;
    function __construct($name) {
        $this->name = $name;
    }
    public function isWorking() {
        if (!$done) {
            return true;
        }
    }
    public function addAction(Callable $func) {
        $this->run = $func;
    }
}