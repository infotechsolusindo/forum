<?php
/**
 *
 */
class ArtikelFactory extends Model {

    function __construct() {
        $database = DB_ENGINE;
        $this->_db = new $database;
    }
    public function ambilSemuaArtikelTerbaru($limit) {
        $sql = "select * from artikel where status = 'A' order by tglposting desc limit $limit";
        return $this->_db->Exec($sql);
    }
    public function ambilSemuaArtikel($penulis) {
        $sql = "select * from artikel where status = 'A' and penulis = '$penulis' order by tglposting desc";
    }
    public function ambilSemuaKarir() {}
    public function ambilSemuaKegiatan() {}
}