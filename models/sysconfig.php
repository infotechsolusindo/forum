<?php
/**
 *
 */
class SysConfig extends Model {

    function __construct() {
        $database = DB_ENGINE;
        $this->_db = new $database;
        $this->_db->setTable('_config');
    }
    public function getIParameter($name) {
        $result = $this->_db->Exec("select * from _config where parmname = '$name' limit 1");
        return $result[0]->parmival;
    }
    public function getSParameter($name) {
        $result = $this->_db->Exec("select * from _config where parmname = '$name' limit 1");
        return $result[0]->parmsval;
    }
}