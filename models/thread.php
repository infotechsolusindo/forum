<?php
class Thread extends Artikel implements IArtikel {
    protected $topik;
    function __construct() {
        parent::__construct(1);
    }
    public function simpan($data) {
        $p = new Artikel(1);
        $p->simpan($data);
    }
    public function baca() {}
    public function setTags($topik) {
        if ($this->topik != '') {
            $this->topik .= ',' . $topik;
        } else {
            $this->topik = $topik;
        }
    }
    public function newtopik($topik) {
        return 1;
    }
    public function setTipe($tipe = 'thread') {
        $this->tipe = $tipe;
    }
    public function uploadFile($file) {
        $file_tmp = $file['tmp_name'];
        $filename = $file['name'];
        $fullpath = ROOT . '/public/data/images/' . $filename;
        move_uploaded_file($file_tmp, $fullpath);
        return $fullpath;
    }
}
