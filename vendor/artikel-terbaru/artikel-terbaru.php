<?php
/**
 *
 */
class ArtikelTerbaru {
    public $title;
    public $img;
    public $shortcontent;
    function __construct() {
        $author = "";
        $artikels = new ArtikelFactory;
        $this->artikels = $artikels->ambilSemuaArtikelTerbaru(5);
    }
}