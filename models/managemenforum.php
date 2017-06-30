<?php
class ManagemenForum extends Forum 
{
	private $wewenang;
	private $admin;
	function __construct(IAdmin $admin){
		if(!$this->cekWewenang($admin)) return false;
		$this->admin = $admin;
		$this->wewenang = $admin->getWewenang();
	}
	private function cekWewenang(IAdmin $admin) {
		return false;
	}
	public function getSemuaThreadKiriman(IAnggota $anggota=null) {}
	public function getSemuaKarirKiriman(IAnggota $anggota=null) {}
	public function getSemuaKegiatanKiriman(IAnggota $anggota=null) {}
}