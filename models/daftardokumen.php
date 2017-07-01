<?php
class DaftarDokumen extends Model {
	protected $tipe;
	protected $judul;
	protected $deskripsi;
	protected $file;
	protected $peserta;
	function __construct() {
		$database = DB_ENGINE;
		$this->_db = new $database;
		$this->_db->setTable('daftardokumen');
	}
	public function tambahDaftar($data) {
		return $this->_db->Create($data);
	}
	public function ubahData($data) {
	}
	public function getDaftar($angkatan) {
		return $this->_db->Exec("select * from daftardokumen where angkatan = '$angkatan'");
	}
}
