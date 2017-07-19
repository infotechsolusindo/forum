<?php
class AdminSeleksi extends Anggota {
    function __construct() {
        parent::__construct();
    }
    public function aktifasiAnggota(IAnggota $anggota) {}
    public function blockAnggota(IAnggota $anggota) {}
    public function hapusAnggota(IAnggota $anggota) {}
    public function getAdminProfile($email, $status = 'A', $wewenang = 2) {
        $result = $this->getProfile($email, $status, $wewenang);
        if (!empty($result)) {
            logs(__CLASS__ . ' tidak ditemukan');
            return false;
        }
    }
}
