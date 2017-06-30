<?php
class AdminSeleksi extends Admin implements IAdmin 
{
	function __construct(IAnggota $peserta){}
	public function aktifasiAnggota(IAnggota $anggota) {}
	public function blockAnggota(IAnggota $anggota) {}
	public function hapusAnggota(IAnggota $anggota) {}
}