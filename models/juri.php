<?php
class Juri extends Anggota implements IAnggota
{
	private $tugasJuri;
	function __construct() {}
	public function getTugasJuri() {
		return $this->tugasJuri;
	}
	public function kirimArtikel(IArtikel $artikel){}
	public function bacaArtikel(IArtikel $artikel){}
	public function kirimKomen(IArtikel $artikel,IKomen $komen){}
	public function bacaKomen(IArtikel $artikel,IKomen $komen){}
}