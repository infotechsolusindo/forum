<?php
class Pendaftaran extends Model {
	private $idpendaftaran;
	private $peserta;
	private $dokumen = [];
	protected $errors = [];
	function __construct() {
		$database = DB_ENGINE;
		$this->_db = new $database;
		$this->_db->setTable('pendaftaran');
	}
	public function tambahPeserta(Peserta $peserta) {
		return $this->peserta = $peserta;
	}
	public function tambahDokumen(Dokumen $dokumen) {
		return $this->dokumen[$dokumen->getTipe()] = $dokumen;
	}
	public function simpanPendaftaran() {
		$data['peserta'] = $this->peserta->getEmail();
		$data['tanggal'] = date('Y-m-d');
		foreach ($this->dokumen as $dokumen) {
			$dokumen->setPeserta($this->peserta->getEmail());
			$result = $dokumen->simpan();
			if ($result) {
				$this->errors[] = $result;
			}
		}
		//Simpan pendaftaran ke database
		$this->_db->create($data);
		if (empty($this->errors)) {
		}
		return $this->errors;
	}
	public function getPendaftaran(Peserta $peserta) {
		$sql = "select * from pendaftaran where status = '1' ";
		if ($peserta) {
			$email = $peserta->getEmail();
			$sql .= "and peserta = '$email'";
		}
		return $this->_db->Exec($sql);
	}
	public function getPendaftaranBaru() {
		$sql = "select anggota.*,pendaftaran.*,wilayah.nama as wilayah
			from pendaftaran
			inner join anggota on anggota.email = pendaftaran.peserta
			left join wilayah on wilayah.id = anggota.wilayah
			where pendaftaran.status = '0' ";
		return $this->_db->Exec($sql);
	}
	public function setStatus($peserta, $status) {
		return $this->_db->Exec("update pendaftaran set status = '$status' where peserta = '$peserta'");
	}
}