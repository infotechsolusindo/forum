<?php
/**
 *
 */
class AnggotaFactory extends Model {
    private $anggotas;
    private $status;
    private $jeniskelamin;
    private $wilayah;
    private $pendidikanterakhir;
    private $angkatan;
    function __construct() {
        $database = DB_ENGINE;
        $this->_db = new $database;
        $this->_db->setTable('anggota');
    }
    public function init() {
        $sql = "select * from anggota";
        if ($this->status != '') {
            $where[] = "status = '$this->status'";
        }
        if ($this->jeniskelamin != '') {
            $where[] = "jeniskelamin = '$this->jeniskelamin'";
        }
        if ($this->wilayah != '') {
            $where[] = 'wilayah = $this->wilayah';
        }
        if ($this->pendidikanterakhir != '') {
            $where[] = "pendidikanterakhir = '$this->pendidikanterakhir'";
        }
        if ($this->angkatan != '') {
            $where[] = "angkatan = $this->angkatan";
        }
        $options = join($where, ' and ');
        $sql = "$sql where $options";
        $anggotas = $this->_db->Exec($sql);
        if (empty($anggotas)) {
            return false;
        }
        foreach ($anggotas as $anggota) {
            $this->anggotas[] = $anggota;
        }
    }
    public function setStatus($status) {
        $this->status = $status;
    }
    public function setJenisKelamin($jeniskelamin) {
        $this->jeniskelamin = $jeniskelamin;
    }
    public function setWilayah($wilayah) {
        $this->wilayah = $wilayah;
    }
    public function setPendidikanTerakhir($pendidikanterakhir) {
        $this->pendidikanterakhir = $pendidikanterakhir;
    }
    public function setAngkatan($angkatan) {
        $this->angkatan = $angkatan;
    }
    public function getAnggotas() {
        $this->init();
        return $this->anggotas;
    }
    public function addAnggota(Anggota $anggota) {
        $this->anggotas[] = $anggota;
    }

}