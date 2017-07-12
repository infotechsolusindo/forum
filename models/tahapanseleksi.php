<?php
class TahapanSeleksi extends Model {
    public $angkatan;
    public $tahap;
    public $item;
    public $deskripsi;
    public $admin;
    function __construct(Admin $admin) {
        $database = DB_ENGINE;
        $this->_db = new $database;
        $this->_db->setTable('tahapanseleksi');
        $this->admin = $admin->getEmail();
        $this->tahap = $tahap;
    }
    public function setAngkatan($angkatan) {
        $this->angkatan = $angkatan;
    }
    public function setItem($item) {
        $this->item = $item;
    }
    public function setDeskripsi($deskripsi) {
        $this->deskripsi = $deskripsi;
    }
    public function simpan() {
        $data = [
            'angkatan' => $this->angkatan,
            'tahap' => $this->tahap,
            'item' => $this->item,
            'deskripsi' => $this->deskripsi,
            'admin' => $this->admin,
            'created' => date('Y-m-d'),
        ];
        return $this->_db->Create($data);
    }
    public function hapus($angkatan, $tahap, $item) {
        return $this->_db->Exec("delete from tahapanseleksi where angkatan = $angkatan and tahap = $tahap and item = '$item'");
    }
    public function getDaftar($angkatan) {
        return $this->_db->Exec("select * from tahapanseleksi where angkatan = $angkatan order by tahap");
    }
}
