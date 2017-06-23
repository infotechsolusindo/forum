<?php
interface IAnggota {
	// Pengelolaan Anggota
	public function getProfile();
	public function ubahProfile();

	// Interaksi Anggota
	public function kirimPesan($to,$isipesan);
	public function balasPesan($idpesan,$isipesan);
	public function hapusPesan($idpesan);

	
	public function tambahKomentar($idartikel);
	public function ubahKomentar($idkomentar);
	public function hapusKomentar($idkomentar);
	public function getKomentarByArtikel($idartikel);
}