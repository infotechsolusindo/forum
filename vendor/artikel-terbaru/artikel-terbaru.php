<?php
/**
* 
*/
class ArtikelTerbaru
{
	public $title;
	public $img;
	public $shortcontent;
	function __construct()
	{
		$author = "";
		$artikels = new Artikel;
		$this->artikels = $artikels->daftarTerbaru($author,5);
	}
}