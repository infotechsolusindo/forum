<?php
/**
* 
*/
class ArtikelForm
{
	private $artikel;

	function __construct()
	{
		$this->artikel = new Artikel();
		$this->kategori = $this->artikel->getKategori();
		$this->judul = "";
		$this->idkategori = "";
		$this->isi = "";
	}
	public function ubah($idartikel)
	{
		$data = $this->artikel->show($idartikel);
		var_dump($data);
		$this->judul = $data[0]->judul;
		$this->idkategori = $data[0]->idkategori;
		$this->isi = $data[0]->isi;
	}
}