<?php
include 'core.php';
include 'library.php';
include 'models.php';

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
//$dok1 = new Dokumen;
//$dok1->setTipe('Berkas1');
//$dok1->setJudul('Biodata');
//$dok1->setFile('file1.cvs');
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

$email = 'A.Septela@Yahoo.Com';

/*
$user = new Akun;
$user->setEmail($email);
$user->setPassword(md5('1234'));
$user->simpanAkun();
$user->setWewenang('0');
$user->update();
 */
$user = new Anggota;
$user->getProfile($email);
var_dump($user);

