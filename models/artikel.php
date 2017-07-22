<?php
class Artikel extends Model {
    protected $idartikel;
    protected $tanggal; /* tanggal posting */
    protected $topik;
    protected $penulis;
    protected $judul;
    protected $isi;
    // protected $gambar;

    protected $tipe;
    protected $komens = [];
    function __construct($id) {
        $database = DB_ENGINE;
        $this->_db = new $database;
        $artikel = "select * from artikel where id = $id";
        $result = $this->_db->Exec($artikel);
        $this->idartikel = $result[0]->id;
        $this->judul = $result[0]->judul;

        $this->getSemuaKomen($this->idartikel);
    }
    public function setTanggal($tanggal) {
        $this->tanggal = $tanggal;
    }
    public function setPenulis($email) {
        $this->penulis = $email;
    }
    public function setJudul($judul) {
        $this->judul = $judul;
    }
    public function setIsi($isi) {
        $this->isi = $isi;
    }
    // public function setGambar($gambar) {
    //     $this->gambar = $gambar;
    // }
    public function getTanggal() {
        return $this->tanggal;
    }
    public function getPenulis() {
        return $this->penulis;
    }
    public function getJudul() {
        return $this->judul;
    }
    public function getIsi() {
        return $this->isi;
    }
    // public function getGambar() {
    //     return $this->gambar;
    // }
    public function getTipe() {
        return $this->tipe;
    }
    public function getTerbaru() {
        $sql = "";
    }
    public function tambahKomentar(IKomen $komen) {
        $this->komens[] = $komen;
    }
    public function bacaKomens() {
        return $this->komens;
    }
    private function getSemuaKomen($kodeartikel) {
        /* Load semua komentar untuk artikel ini */
    }
}