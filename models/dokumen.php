<?php
class Dokumen extends Model {
	protected $tipe;
	protected $judul;
	protected $deskripsi;
	protected $namafile;
	protected $file;
	protected $peserta;
	function __construct() {
		$database = DB_ENGINE;
		$this->_db = new $database;
		$this->_db->setTable('dokumen');
	}
	private function uploadFile($file) {
		$file_name;
		$file_type;
		$file_size;
		$file_tmp;
		var_dump($file);
		logs('Upload ' . $file);
		return true;
	}
	public function getTipe() {
		return $this->tipe;
	}
	public function setNamaFile($namafile) {
		$this->namafile = $namafile;
	}
	public function setTipe($tipe) {
		$this->tipe = $tipe;
	}
	public function setJudul($judul) {
		$this->judul = $judul;
	}
	public function setDeskripsi($deskripsi) {
		$this->deskripsi = $deskripsi;
	}
	public function setFile($file) {
		//if($this->uploadFile($file)){
		//	$this->file = $file;
		//	return;
		//}
		$this->file = $file;
		logs('Upload :' . $file);
	}
	public function setPeserta($peserta) {
		$this->peserta = $peserta;
	}
	public function simpan() {
		$data['tipe'] = $this->tipe;
		$data['judul'] = $this->judul;
		$data['deskripsi'] = isset($this->deskripsi) && ($this->deskripsi != '') ? $this->deskripsi : '-';
		$data['namafile'] = $this->namafile;
		$data['file'] = $this->file;
		$data['peserta'] = $this->peserta;
		return $this->_db->create($data, 'update');
	}
	public function getDokumen($id) {
		$result = $this->_db->Exec("select * from dokumen where iddokumen = $id");
		if (empty($result)) {
			return false;
		}

		$this->setNamaFile($result[0]->namafile);
		$this->setTipe($result[0]->tipe);
		$this->setJudul($result[0]->judul);
		$this->setFile($result[0]->file);
	}
	public function getDokumens($pemilik) {
		return $this->_db->Exec("select * from dokumen where peserta = '$pemilik'");
	}
	public function hapus($id) {
		$this->getDokumen($id);
		$error = $this->_db->Exec("delete from dokumen where iddokumen = $id");
		if (!$error) {
			if (file_exists($this->file)) {
				unlink($this->file);
			}
		}
	}
}
