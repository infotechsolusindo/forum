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
    public function setIParameter($nama, $value) {
        return $this->_db->Exec("update _config set parmival = $value where parmname = '$nama'");
    }
    public function setSParameter($nama, $value) {
        return $this->_db->Exec("update _config set parmsval = '$value' where parmname = '$nama'");
    }
}