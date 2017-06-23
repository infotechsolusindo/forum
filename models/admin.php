<?php
/**
* 
*/
class Admin extends Anggota
{
	function __construct(Akun $akun){
		$this->akun = $akun;
	}

	// Pengelolaan Anggota Lain
	public function blockAkun(Akun $akun){}
	public function openAkun(Akun $akun){}

	// Pengelolaan Artikel
	public function otorisasiArtikel(Artikel $artikel){}
	public function hapusArtikel(Artikel $artikel){}

	// Pengelolaan Pesan
	public function lihatSemuaPesanTerbaru(){}
	public function hapusSemuaPesan(){}

}