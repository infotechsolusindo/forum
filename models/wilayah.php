
<?php
/**
 *
 */
class Wilayah extends Model {

    public function __construct() {
        $database = DB_ENGINE;
        $this->_db = new $database;
        $this->_db->setTable('wilayah');
    }

    public function getWilayah($id = null) {
        $sql = "select * from wilayah";
        if ($id) {
            $sql .= " where id = $id";
        }
        return $this->_db->Exec($sql);
    }
}
