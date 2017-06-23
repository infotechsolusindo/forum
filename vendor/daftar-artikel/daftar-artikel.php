<?php
/**
* 
*/
class DaftarArtikel
{
	private $artikel;

	function __construct()
	{
		$this->artikel = new Artikel();
		$this->artikel->setAuthor($_SESSION['id']);
		$this->index();
	}

	public function index()
	{
		$this->daftar = $this->artikel->daftarArtikel();
	}

}