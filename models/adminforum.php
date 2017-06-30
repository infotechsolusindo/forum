<?php
class AdminForum extends Admin implements IAdmin 
{
	public function aktifasiAnggota(IAnggota $anggota) {}
	public function blockAnggota(IAnggota $anggota) {}
	public function hapusAnggota(IAnggota $anggota) {}
}