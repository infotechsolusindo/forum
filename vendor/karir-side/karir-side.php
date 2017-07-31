<?php
/**
 *
 */
class KarirSide {

    function __construct() {
        $author = "";
        $artikels = new ArtikelFactory;
        $this->artikels = $artikels->ambilSemuaArtikelTerbaru(5);
    }
}