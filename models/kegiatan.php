<?php
class Kegiatan extends Artikel implements IArtikel 
{
	private $jadwal;
	private $durasi;
	private $biaya;
	public function simpan($data){}
	public function baca(){}
	public function setTipe($tipe='kegiatan'){
		$this->tipe = $tipe;
	}
	public function setJadwal($hari,$tanggal,$jam=null){}
	public function setDurasi($hari=null,$jam=null){}
	public function setBiaya($biaya) {}
}