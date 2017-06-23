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
		$artikels = new Artikel;
		
		$this->title = "testing";
		$this->img = "";
		$this->shortcontent ="";
	}
}