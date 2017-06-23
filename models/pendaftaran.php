<?php
/**
* 
*/
class Pendaftaran
{
	private $loginid;
	private $dokumens = [];
	private $capaska;

	function __construct(Capaska $capaska)
	{
		$this->capaska = $capaska;
	}

	private function simpanPendaftaran() {
		/*
			Simpan Pendaftaran ke Tabel Pendaftaran
			dan Capaska ke Tabel Capaska untuk di review oleh Admin Seleksi

			Kirim email notifikasi ke Admin Seleksi 
			dan email notifikasi ke pendaftar bahwa pendaftaran diterima untuk direview.
		*/
	}

	public function tambahDokumen($dokumen) {
		$this->dokumens[] = $dokumen;
	}

	public function getLoginId() {
		return '';
	}
}