<?php
class Admin extends Anggota implements IAnggota
{
	protected $wewenang;
	public function getWewenang() {}
	public function kirimArtikel(IArtikel $artikel){}
	public function bacaArtikel(IArtikel $artikel){}
	public function kirimKomen(IArtikel $artikel,IKomen $komen){}
	public function bacaKomen(IArtikel $artikel,IKomen $komen){}
}
