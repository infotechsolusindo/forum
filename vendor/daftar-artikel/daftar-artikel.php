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
        // $this->artikels = $this->artikels->ambilSemuaArtikel($this->penulis);
        $this->artikels = $this->artikels->getArtikelsThread();
        $this->index();
    }

    public function index() {

    }

}