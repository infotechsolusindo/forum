<?php
class ServiceClient {
    private $data = [];
    protected $procname;
    function __construct($procname) {
        $this->procname = $procname;
    }
    public function addData($data, $name = null) {
        $this->data[$name] = $data;
    }
    public function getData() {
        $data = [
            'procname' => $this->procname,
            'data' => json_encode($this->data),
        ];
        return $data;
    }
}