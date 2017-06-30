<?php
class Peserta extends Anggota
{
	function __construct(){
		parent::__construct();
	}
	public function simpan(){
		$data['email'] = $this->getEmail();
		$data['password'] = $this->getPassword();
                logs('simpan akun');
                $this->simpanAkun($data);
                logs('simpan anggota');
		$this->simpanAnggota();
	}
	public function verifyPassword($password,$konfirmasi) {
		if($password===$konfirmasi) return true;
	}
	public function cekStatusPendaftaran() {}
	public function cekStatusSeleksi() {}
}
