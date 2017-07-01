<?php
class Peserta extends Anggota
{
    public function __construct()
    {
        parent::__construct();
    }
    public function simpan()
    {
        $data['email'] = $this->getEmail();
        $data['password'] = $this->getPassword();
        logs('simpan akun');
        $this->simpanAkun($data);
        logs('simpan anggota');
        $this->simpanAnggota();
    }

    public function cekStatusPendaftaran()
    {}
    public function cekStatusSeleksi()
    {}
}
