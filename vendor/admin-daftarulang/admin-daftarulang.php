<?php
/**
 *
 */
class AdminDaftarulang {
    function __construct() {
        $pendaftaran = new Pendaftaran;
        $this->anggota = $pendaftaran->getPendaftaranUlang();
    }
    // public function ubah($idartikel) {
    //     $data = $this->artikel->show($idartikel);
    //     var_dump($data);
    //     $this->judul = $data[0]->judul;
    //     $this->idkategori = $data[0]->idkategori;
    //     $this->isi = $data[0]->isi;
    // }
}