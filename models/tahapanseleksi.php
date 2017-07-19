<?php
class TahapanSeleksi extends Model {
    private $juri;
    private $angkatan;
    private $daftartahapan = [];

    function __construct() {
        $database = DB_ENGINE;
        $this->_db = new $database;
    }
    public function setJuri(Anggota $juri) {
        $this->juri = $juri->getEmail();
    }
    public function setAngkatan($angkatan) {
        $this->angkatan = $angkatan;
    }
    public function tambahBerkas($tahap, $item, $deskripsi = '') {
        $daftartahapan['angkatan'] = $this->angkatan;
        $daftartahapan['juri'] = $this->juri;
        $daftartahapan['tahap'] = $tahap;
        $daftartahapan['item'] = $item;
        $daftartahapan['deskripsi'] = $deskripsi;

        $this->daftartahapan[] = $daftartahapan;
    }
    public function simpan() {
        $this->_db->setTable('tahapanseleksi');
        foreach ($this->daftartahapan as $tahapan) {
            $this->_db->create($tahapan);
        }
    }
    public function getTahapan() {
        $juri = $this->juri;
        $angkatan = $this->angkatan;
        if ($juri == '') {
            logs('Admin user/juri belum di set');
            return false;
        }
        return $this->_db->Exec("select * from tahapanseleksi where juri = '$juri' and angkatan = $angkatan");
    }
    public function getSemuaTahap($angkatan) {
        return $this->_db->Exec("select distinct tahap from tahapanseleksi where angkatan = $angkatan");
    }
    public function getSemuaTahap($angkatan) {
        return $this->_db->Exec("select distinct tahap from tahapanseleksi where angkatan = $angkatan");
    }
}
