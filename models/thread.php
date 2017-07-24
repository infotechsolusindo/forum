<?php
class Thread extends Artikel implements IArtikel 
{
	protected $topik;
	function __construct(){
		parent::__construct();
	}
	public function simpan($data){}
	public function baca(){}
	public function setTopik($topik){
		if($this->topik!=''){
			$this->topik .= ','.$topik;
		} else {
			$this->topik = $topik;
		}
	}
	public function setTipe($tipe='thread'){
		$this->tipe = $tipe;
	}
}
