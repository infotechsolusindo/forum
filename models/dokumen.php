<?php
class Dokumen extends Model
{
	protected $tipe;
	protected $judul;
	protected $deskripsi;
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
		logs('Upload '.$file);
		return true;
	}
	public function getTipe(){
		return $this->tipe;
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
		logs('Upload :'.$file);
	}
	public function setPeserta($peserta) {
		$this->peserta = $peserta;
	}
	public function simpan() {
		$data['tipe'] = $this->tipe;
		$data['judul'] = $this->judul;
		$data['deskripsi'] = isset($this->deskripsi)&&($this->deskripsi!='')?$this->deskripsi:'-';
		$data['file'] = $this->file;
		$data['peserta'] = $this->peserta;
		return $this->_db->create($data);
	}
}
