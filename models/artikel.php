<?php
/**
* 
*/
class Artikel extends Model implements IArtikel
{
	private $_author;
	private $_type;

	function __construct()
	{
        $database = DB_ENGINE;
        $this->_db = new $database;
        $this->_db->setTable('artikel','idartikel');
        $this->setType();
	}
	protected function setType($type='000'){
		$this->_type = $type;
	}
	public function add(){

	}
	public function edit(){

	}
	public function remove(){

	}
	public function show($id){
		$sql = "SELECT * FROM artikel WHERE idartikel = $id";
		return $this->_db->Exec($sql);
	}
	public function getAuthor(){

	}
	public function setAuthor($userid){
		$this->_author = $userid;
	}
	public function daftarArtikel($author=null){
		$author = !isset($author)?$_SESSION['id']:$author;
		$sql = "SELECT ". 
			    "artikel.*,".
				"artikelkategori.* ".
				"FROM artikel ".
				"INNER JOIN artikelkategori ON artikelkategori.idkategori = artikel.idkategori ".
				"WHERE ".
				"author = '$author' AND ".
				"type = '00' AND ".
				"artikel.status <> 'D' ".
				"ORDER BY artikel.idkategori";
		return $this->_db->Exec($sql);
	}
	public function daftarTerbaru($author=null){
		$author = !isset($author)?$_SESSION['id']:$author;
		$sql = "SELECT ". 
			    "artikel.*,".
				"artikelkategori.* ".
				"FROM artikel ".
				"INNER JOIN artikelkategori ON artikelkategori.idkategori = artikel.idkategori ".
				"WHERE ".
				"author = '$author' AND ".
				"type = '00' AND ".
				"artikel.status <> 'A' ".
				"ORDER BY artikel.tgl DESC,artikel.jam DESC";
		return $this->_db->Exec($sql);
	}
	public function getKategori(){
		$sql = "SELECT * FROM artikelkategori WHERE status = 'A'";
		return $this->_db->Exec($sql);
	}
}
