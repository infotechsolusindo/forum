<?php
/**
 *
 */
class ArtikelFactory extends Model {
    private $artikels = [];

    function __construct() {
        $database = DB_ENGINE;
        $this->_db = new $database;
    }
    public function ambilSemuaArtikelTerbaru($limit) {
        $sql = "select * from artikel where status = 'A' order by tglposting desc limit $limit";
        return $this->_db->Exec($sql);
    }
    public function ambilSemuaArtikel($penulis) {
        $sql = "select * from artikel where status = 'A' and penulis_email = '$penulis' order by tglposting desc";
        return $this->_db->Exec($sql);
    }
    public function getArtikelsThread($options = []) {
        $select = "select ";
        $from = "from artikel";

        $data[] = "artikel.*";
        $table[] = "artikel ";
        $datas = join($data, ',');
        $tables = "inner join f";
        $sql = "select * from artikel where tipe = 1";
        return $this->_db->Exec($sql);

    }
    public function ambilSemuaKarir() {}
    public function ambilSemuaKegiatan() {}
}