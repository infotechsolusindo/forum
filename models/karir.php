<?php
class Karir extends Artikel implements IArtikel 
{
	private $gaji;
	private $bataswaktu;
	private $info;
	public function simpan($data){}
	public function baca(){}
	public function setTipe($tipe='karir'){
		$this->tipe = $tipe;
	}
	public function setGaji($gaji) {}
	public function bataswaktu($hari=null,$tanggal=null,$jam=null) {}
}