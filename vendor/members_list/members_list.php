<?php
class MembersList {
    public $list;
    public $disable;

    public function __construct() {
        $this->height = '';
        if (!isset($_SESSION['wewenang']) || ($_SESSION['wewenang'] == 's') || $_SESSION['wewenang'] == 'x') {
            $this->disable = true;
        }
        $this->height = '380px';
        $anggotas = $this->getAllAnggota();
        if (!empty($anggotas)) {
            $this->a = $anggotas;
        }
    }
    public function __Invoke() {
        return 'test';
    }

    private function getAllAnggota() {
        $anggotas = new AnggotaFactory;
        $anggotas->setStatus('A');
        $anggotas->init();
        return $anggotas->getAnggotas();
    }
}