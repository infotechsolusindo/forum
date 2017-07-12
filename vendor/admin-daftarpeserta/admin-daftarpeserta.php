<?php
/**
 *
 */
class AdminDaftarpeserta extends Module {
    function __construct() {
        $seleksi = new Seleksi;
        $this->pesertas = $seleksi->getPesertas('D');
    }
    public function detail($id) {
        // include MODULE . strtolower('admin-daftarpeserta') . DS . 'test.php';
        $v = new View;
        include $this->Render(strtolower('admin-daftarpeserta') . DS . 'test.php');
    }
    public function block() {

    }
    public function hapus($id) {

    }
    // public function ubah($idartikel) {
    //     $data = $this->artikel->show($idartikel);
    //     var_dump($data);
    //     $this->judul = $data[0]->judul;
    //     $this->idkategori = $data[0]->idkategori;
    //     $this->isi = $data[0]->isi;
    // }
}