<?php
interface IAdmin 
{
	public function aktifasiAnggota(IAnggota $anggota);
	public function blockAnggota(IAnggota $anggota);
	public function hapusAnggota(IAnggota $anggota);
}