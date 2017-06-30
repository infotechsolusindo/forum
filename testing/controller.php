<?php
define('DS','/');
define('ROOT','/www/forum.localhost/');
include ROOT.'/config/config.php';
include ROOT.'/library/controller.php';
include ROOT.'/library/database.php';
include ROOT.'/library/model.php';
include ROOT.'/library/mysql.php';
require ROOT.'/models/akun.php';
require ROOT.'/models/anggota.php';
require ROOT.'/models/ianggota.php';
require ROOT.'/models/admin.php';
require ROOT.'/models/iadmin.php';
require ROOT.'/models/adminforum.php';
require ROOT.'/models/adminseleksi.php';
require ROOT.'/models/juri.php';

require ROOT.'/models/artikel.php';
require ROOT.'/models/iartikel.php';
require ROOT.'/models/aturanseleksi.php';
require ROOT.'/models/dokumen.php';
require ROOT.'/models/formulir.php';
require ROOT.'/models/forum.php';
require ROOT.'/models/ikomen.php';
require ROOT.'/models/karir.php';
require ROOT.'/models/kegiatan.php';
require ROOT.'/models/komen.php';
require ROOT.'/models/komenkarir.php';
require ROOT.'/models/komenkegiatan.php';
require ROOT.'/models/komenthread.php';
require ROOT.'/models/managemenforum.php';
require ROOT.'/models/pendaftaran.php';
require ROOT.'/models/peserta.php';
require ROOT.'/models/seleksi.php';
require ROOT.'/models/thread.php';

function logs($message){
	echo $message.PHP_EOL;
}

// include ROOT.'/library/bootstrap.php';

// Pendaftaran Peserta
//$capaska = new Peserta;
//$capaska->setEmail('brahmantyo.adi@gmail.com');
//$capaska->setPassword(md5('123'));
//$capaska->setNRA('');	//*
//$capaska->setNamaPanggilan('');		//*
//$capaska->setNamaLengkap('');
//$capaska->setAngkatan('2017');			//*
//$capaska->setJenisKelamin('L');		//*
//$capaska->setTempatLahir('');		//*
//$capaska->setTglLahir('1980-04-21');			//*
//$capaska->setNomerPonsel('');
//$capaska->setAlamatDomisili('');
//$capaska->setPendidikanTerakhir('S1'); //*
//$capaska->setPekerjaan('');
//$capaska->setInstitusi('');
//$capaska->setJabatan('');
//$capaska->setFoto('');
//$capaska->setStatus('D');			//*
//$capaska->simpan();
// var_dump($capaska);
$dok1 = new Dokumen;
$dok1->setTipe('Berkas1');
$dok1->setJudul('Biodata');
$dok1->setFile('file1.cvs');
/*
$dok2 = new Dokumen;
$dok2->setTipe('Berkas2');
$dok2->setJudul('Data Orang Tua / Wali');

$dok3 = new Dokumen;
$dok3->setTipe('Berkas3');
$dok3->setJudul('Ketrampilan');

$dok4 = new Dokumen;
$dok4->setTipe('Berkas4');
$dok4->setJudul('Data Sekolah');

$dok5 = new Dokumen;
$dok5->setTipe('Berkas5');
$dok5->setJudul('Lampiran');

$register = new Pendaftaran;
$register->tambahPeserta($capaska);
$register->tambahDokumen($dok1);
$register->tambahDokumen($dok2);
$register->tambahDokumen($dok3);
$register->tambahDokumen($dok4);
$register->tambahDokumen($dok5);
$register->simpanPendaftaran();
*/





/*
$myforum = new Forum($member);


$mythread = new Thread;
$mythread->setJudul('Ini adalah artikel pertamaku');
$myforum->tambah($mythread);
// var_dump($myforum);
*/
