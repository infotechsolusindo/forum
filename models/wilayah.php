<?php
/**
 *
 */
class Wilayah extends Model
{

    public function __construct()
    {
        $database = DB_ENGINE;
        $this->_db = new $database;
        $this->_db->setTable('wilayah');
    }

    public function getWilayah()
    {
        return $this->_db->Exec('select * from wilayah');
    }
}
