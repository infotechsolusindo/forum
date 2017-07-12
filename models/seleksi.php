<?php
class Seleksi extends Model {
    public $angkatan;
    public $wilayah;
    public $tahap;
    private $peserta;
    private $pesertas = [];
    private $aturan = [];
    private $pendaftaran = [];
    private $dataseleksi = [];
    private $juri = [];
    function __construct() {
        $database = DB_ENGINE;
        $this->_db = new $database;
        $this->_db->setTable('seleksi');
    }
    public function tambahSeleksi(Peserta $peserta) {
    	$pendaftaran = new Pendaftaran;
    	if($pendaftaran->verify($peserta)){
    		$tahapanseleksi = new TahapanSeleksi();
    		$tahapanseleksi->setAngkatan($this->angkatan);
    		$wilayah = new Wilayah;
    		$wilayah->setWilayah($peserta->wilayah);
	        foreach ($tahapanseleksi->getDaftar($this->angkatan) as $ts) {
	            $seleksi = [
	            	'tgl' => date('Y-m-d'),
	            	'angkatan' => $angkatan,
	            	'wilayah' => $wilayah,
	            	'tahap' => $ts->tahap,
	            	'item' => $ts->item,
	            	'idpeserta' => $peserta->getEmail(),
	            	'jeniskelamin' => $peserta->getJenisKelamin()
	            ];
	        }
	        $this->dataseleksi[] = $seleksi;
	    } else {
	    	logs('Peserta tidak berhak untuk ikut seleksi');
	    	return false;
	    }
    }

    public function setAturan(TahapanSeleksi $tahapan, AdminSeleksi $admin) {
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
