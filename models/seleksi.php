<?php
class Seleksi extends Model {
	private $peserta;
	private $pesertas = [];
	private $aturan = [];
	private $pendaftaran = [];
	private $dataseleksi = [];
	private $juri = [];
	function __construct() {
		$database = DB_ENGINE;
		$this->_db = new $database;
		$this->_db->setTable('seleksi');}
	public function setAturan(AturanSeleksi $aturan, AdminSeleksi $admin) {
		$this->aturan = $aturan;
	}

	public function getSemuaPendaftaran() {
		$sql = "select * from pendaftaran where status = '0'";
		$this->_db->Exec($sql);
	}
	public function tambahJuri(Juri $juri) {
		$this->juri[$juri->getTugasJuri()] = $juri;
	}
	public function getPesertas($status) {
		$pesertas = $this->_db->Exec("select * from anggota where status = '$status'");
		foreach ($pesertas as $p) {
			$peserta = new Peserta;
			$peserta->getProfile($p->email, $status);
			$this->pesertas[] = $peserta;
		}
		return $this->pesertas;
	}

}