<?php
class Pendaftaran extends Model 
{
	private $idpendaftaran;
	private $peserta;
	private $dokumen = [];
	protected $errors = [];
	function __construct(){
		$database = DB_ENGINE;
        $this->_db = new $database;
        $this->_db->setTable('pendaftaran');
	}
	public function tambahPeserta(Peserta $peserta){
		$this->peserta = $peserta;
	}
	public function tambahDokumen(Dokumen $dokumen){
		$this->dokumen[$dokumen->getTipe()] = $dokumen;
	}
	public function simpanPendaftaran() {
		$result = $this->peserta->simpan();
		if(!empty($result->error)){
			$this->errors[] = $result->error;
			return $result;
		}
		$data['peserta'] = $this->peserta->getEmail();
		$data['tanggal'] = date('Y-m-d');
		foreach ($this->dokumen as $dokumen) {
			$dokumen->setPeserta($this->peserta->getEmail());
			$this->errors[] = $dokumen->simpan();
		}
		//Simpan pendaftaran ke database
		$this->_db->create($data);
		if(empty($this->errors)){
		}
	}
}