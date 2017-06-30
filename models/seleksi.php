<?php
class Seleksi extends Model 
{
	private $peserta;
	private $aturan = [];
	private $pendaftaran = [];
	private $dataseleksi = [];
	private $juri = [];
	function __construct() {
	}
	public function setAturan(AturanSeleksi $aturan,AdminSeleksi $admin){
		$this->aturan = $aturan;
	}

	public function getSemuaPendaftaran() {
		$sql = "select * from pendaftaran where status = '0'";
		$this->_db->Exec($sql);
	}
	public function tambahJuri(Juri $juri) {
		$this->juri[$juri->getTugasJuri()] = $juri;
	}
	
}