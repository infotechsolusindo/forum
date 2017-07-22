<?php
/**
 *
 */
class DaftarArtikel {
    public $artikels;
    private $penulis;

    function __construct() {
        $this->penulis = $_SESSION['id'];
        $this->artikels = new ArtikelFactory;
        $this->artikels = $this->artikels->ambilSemuaArtikel($this->penulis);
        $this->index();
    }

    public function index() {

    }

}