<?php
class Forum extends Model 
{
	private $error;
	protected $anggota;
	protected $artikels = [];
	function __construct(Anggota $anggota){
		$this->anggota = $anggota;
	}
	public function baca(IArtikel $artikel){}
	public function tambah(IArtikel $artikel){
		$this->artikels[$artikel->getTipe()] = $artikel;
	}
	public function ubah(IArtikel $artikel){}
	public function hapus(IArtikel $artikel){}

	public function getSemuaThread() {}
	public function getSemuaThreadTerbaru($top=10){}
	public function getSemuaKarir() {}
	public function getSemuaKarirTerbaru($top=10) {}
	public function getSemuaKegiatan() {}
	public function getSemuaKegiatanTerbaru($top=10) {}
}