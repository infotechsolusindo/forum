<?php
class AturanSeleksi extends Model 
{
	private $admin;
	private $angkatan;
	private $daftarAturan = [];

	function __construct(AdminSeleksi $admin) {
		$database = DB_ENGINE;
        $this->_db = new $database;
        $this->admin = $admin;
	}
	public function setAngkatan($angkatan) {
		$this->angkatan = $angkatan;
	}
	public function tambahBerkas($nomer,$nama,$wajib=false){
		$daftarAturan['angkatan'] = $this->angkatan;
		$daftarAturan['admin'] = $this->admin->nra;
		$daftarAturan['nomer'] = $nomer;
		$daftarAturan['nama'] = $nama;
		$daftarAturan['wajib'] = $wajib;
		$this->daftarAturan[] = $daftarAturan;
	}
	public function simpan() {
		$this->_db->setTable('aturanseleksi');
		foreach ($this->daftarAturan as $aturan) {
			$this->_db->create($aturan);
		}
	}
}