<?php
/**
* 
*/
class Anggota
{
	protected $akun;
	
	function __construct()
	{
		# code...
	}

	// Interaksi Anggota
	public function kirimPesan(Pesan $pesan){
		return $pesan->send();
	}
	public function balasPesan(Pesan $pesan,$idpesan){
		return $pesan->reply($idpesan);
	}
	public function hapusPesan(Pesan $pesan){
		return $pesan->remove();
	}

	// Kelola Artikel
	public function tambahArtikel(Artikel $artikel){
		return $artikel->add();
	}
	public function ubahArtikel(Artikel $artikel){
		return $artikel->edit();
	}
	public function hapusArtikel(Artikel $artikel){
		return $artikel->remove();
	}
	public function getArtikel(){ // Load all artikel by this anggota
		$artikels = new Artikel;
		$artikels->getByAuthor();
		return $artikels;
	}


	// Kelola Komentar
	public function tambahKomentar(Komentar $komentar){
		return $komentar->send();
	}
	public function ubahKomentar(Komentar $komentar){
		return $komentar->edit();
	}
	public function hapusKomentar(Komentar $komentar){
		return $komentar->remove();
	}
	public function getKomentar(){
		$komentars = new Komentar;
		$komentars->getByAuthor();
		return $komentars;
	}

}