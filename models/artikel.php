<?php
class Artikel extends Model 
{
	protected $kodeartikel;
	protected $tanggal; /* tanggal posting */
	protected $nra;
	protected $judul;
	protected $isi;
	protected $gambar;

	protected $tipe;
	protected $komens = [];
	function __construct(){
		$this->getSemuaKomen($this->kodeartikel);
	}
	public function setTanggal($tanggal){
		$this->tanggal = $tanggal;
	}
	public function setNRA($nra){
		$this->nra = $nra;
	}
	public function setJudul($judul){
		$this->judul = $judul;
	}
	public function setIsi($isi){
		$this->isi = $isi;
	}
	public function setGambar($gambar){
		$this->gambar = $gambar;
	}
	public function getTanggal(){
		return $this->tanggal;
	}
	public function getNRA(){
		return $this->nra;
	}
	public function getJudul(){
		return $this->judul;
	}
	public function getIsi(){
		return $this->isi;
	}
	public function getGambar(){
		return $this->gambar;
	}
	public function getTipe(){
		return $this->tipe;
	}
	public function getTerbaru(){
		$sql = "";
	}
	public function tambahKomentar(IKomen $komen){
		$this->komens[] = $komen;
	}
	public function bacaKomens(){
		return $this->komens;
	}
	private function getSemuaKomen($kodeartikel){
		/* Load semua komentar untuk artikel ini */
	}
}