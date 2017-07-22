<?php
class Anggota extends Akun {
    private $akun;
    private $fotopath = '/public/tmp/';
    protected $nra;
    protected $namalengkap;
    protected $namapanggilan;
    protected $angkatan;
    protected $jeniskelamin;
    protected $tempatlahir;
    protected $tgllahir;
    protected $nomerponsel;
    protected $alamatdomisili;
    protected $wilayah;
    protected $pendidikanterakhir;
    protected $pekerjaan;
    protected $institusi;
    protected $jabatan;
    protected $foto;
    protected $status;
    public function __construct() {
        $this->akun = parent::__construct();
        $this->_db->setTable('anggota');
        $this->reset();
    }
    private function uploadFile($file) {
        $arrfile = explode('.', $file['name']);
        $file_ext = strtolower(end($arrfile));
        $file_tmp = $file['tmp_name'];
        $filename = md5($this->email) . '.' . $file_ext;
        $fullpath = ROOT . $this->fotopath . $filename;
        move_uploaded_file($file_tmp, $fullpath);
        return $this->fotopath . $filename;
    }
    public function setNRA($nra) {
        $this->nra = $nra;
    }
    public function setNamaLengkap($namalengkap) {
        $this->namalengkap = $namalengkap;
    }
    public function setNamaPanggilan($namapanggilan) {
        $this->namapanggilan = $namapanggilan;
    }
    public function setEmail($email) {
        $this->email = $email;
    }
    public function setAngkatan($angkatan) {
        $this->angkatan = $angkatan;
    }
    public function setJenisKelamin($jeniskelamin) {
        $this->jeniskelamin = $jeniskelamin;
    }
    public function setTempatLahir($tempatlahir) {
        $this->tempatlahir = $tempatlahir;
    }
    public function setTglLahir($tgllahir) {
        if ($tgllahir == '') {
            $tgllahir = '1945-08-17';
        }

        $this->tgllahir = $tgllahir;
    }
    public function setNomerPonsel($nomerponsel) {
        $this->nomerponsel = $nomerponsel;
    }
    public function setAlamatDomisili($alamatdomisili) {
        $this->alamatdomisili = $alamatdomisili;
    }
    public function setWilayah($wilayah) {
        $this->wilayah = $wilayah;
    }
    public function setPendidikanTerakhir($pendidikanterakhir) {
        $this->pendidikanterakhir = $pendidikanterakhir;
    }
    public function setPekerjaan($pekerjaan) {
        $this->pekerjaan = $pekerjaan;
    }
    public function setInstitusi($institusi) {
        $this->institusi = $institusi;
    }
    public function setJabatan($jabatan) {
        $this->jabatan = $jabatan;
    }
    public function setFoto($foto) {
        if (!$foto || $foto == '') {
            return '';
        }
        $filefoto = $this->uploadFile($foto);
        $this->foto = $filefoto;
    }
    public function setFotoVar($foto) {
        $this->foto = $foto;
    }
    public function setStatus($status) {
        $this->status = $status;
    }
    public function getEmail() {
        return $this->email;
    }
    public function getPassword() {
        return $this->password;
    }
    public function getStatus() {
        return $this->status;
    }
    public function getNRA() {
        return $this->nra;
    }
    public function getNamaLengkap() {
        return $this->namalengkap;
    }
    public function getNamaPanggilan() {
        return $this->namapanggilan;
    }
    public function getAngkatan() {
        return $this->angkatan;
    }
    public function getJenisKelamin() {
        return $this->jeniskelamin;
    }
    public function getTempatLahir() {
        return $this->tempatlahir;
    }
    public function getTglLahir() {
        return $this->tgllahir;
    }
    public function getNomerPonsel() {
        return $this->nomerponsel;
    }
    public function getAlamatDomisili() {
        return $this->alamatdomisili;
    }
    public function getWilayah() {
        return $this->wilayah;
    }
    public function getPendidikanTerakhir() {
        return $this->pendidikanterakhir;
    }
    public function getPekerjaan() {
        return $this->pekerjaan;
    }
    public function getInstitusi() {
        return $this->institusi;
    }
    public function getJabatan() {
        return $this->jabatan;
    }
    public function getFoto() {
        return $this->foto;
    }
    // --------------------------------------------------------------------------------
    public function simpanAnggota() {
        $name = basename($this->foto);
        if ($name != '') {
            rename(ROOT . $this->foto, ROOT . '/public/data/foto/' . $name);
            $this->foto = '/public/data/foto/' . $name;
        }
        $data = [
            'nra' => $this->nra,
            'namalengkap' => $this->namalengkap,
            'namapanggilan' => $this->namapanggilan,
            'email' => $this->email,
            'angkatan' => $this->angkatan,
            'jeniskelamin' => $this->jeniskelamin,
            'tempatlahir' => $this->tempatlahir,
            'tgllahir' => $this->tgllahir,
            'nomerponsel' => $this->nomerponsel,
            'alamatdomisili' => $this->alamatdomisili,
            'wilayah' => $this->wilayah,
            'pendidikanterakhir' => $this->pendidikanterakhir,
            'pekerjaan' => $this->pekerjaan,
            'institusi' => $this->institusi,
            'jabatan' => $this->jabatan,
            'foto' => $this->foto,
            'status' => $this->status == '' ? 'D' : $this->status,
        ];
        return $this->_db->create($data);
    }
    public function update() {
        parent::update();
        $this->_db->setTable('anggota');
        $data = [
            'nra' => $this->nra,
            'namalengkap' => $this->namalengkap,
            'namapanggilan' => $this->namapanggilan,
            'angkatan' => $this->angkatan,
            'jeniskelamin' => $this->jeniskelamin,
            'tempatlahir' => $this->tempatlahir,
            'tgllahir' => $this->tgllahir,
            'nomerponsel' => $this->nomerponsel,
            'alamatdomisili' => $this->alamatdomisili,
            'wilayah' => $this->wilayah,
            'pendidikanterakhir' => $this->pendidikanterakhir,
            'pekerjaan' => $this->pekerjaan,
            'institusi' => $this->institusi,
            'jabatan' => $this->jabatan,
            'foto' => $this->foto,
            'status' => $this->status,
            'email' => $this->email,
        ];
        return $this->_db->create($data, 'update');
    }
    // public function set($nra) {
    //     $this->_db->setTable('anggota');
    //     $anggota = $this->_db->Exec("select * from akun,anggota where akun.email = anggota.email and anggota.nra = '$nra[id]'");
    //     $anggota = $anggota[0];
    //     $this->setEmail($anggota->email);
    //     $this->setPassword($anggota->password);
    //     $this->setNRA($anggota->nra); //*
    //     $this->setNamaPanggilan($anggota->namapanggilan); //*
    //     $this->setNamaLengkap($anggota->namalengkap);
    //     $this->setAngkatan($anggota->angkatan); //*
    //     $this->setJenisKelamin($anggota->jeniskelamin); //*
    //     $this->setTempatLahir($anggota->tempatlahir); //*
    //     $this->setTglLahir($anggota->tgllahir); //*
    //     $this->setNomerPonsel($anggota->nomerponsel);
    //     $this->setAlamatDomisili($anggota->alamatdomisili);
    //     $this->setWilayah($anggota->wilayah);
    //     $this->setPendidikanTerakhir($anggota->pendidikanterakhir); //*
    //     $this->setPekerjaan($anggota->pekerjaan);
    //     $this->setInstitusi($anggota->institusi);
    //     $this->setJabatan($anggota->jabatan);
    //     $this->setFotoVar($anggota->foto);
    //     $this->setStatus($anggota->status); //*
    // }
    public function getProfile($email, $status = 'A', $wewenang = null) {
        $sql = "select * from akun inner join anggota on anggota.email = akun.email where anggota.email = '$email' and status = '$status'";
        if ($wewenang) {
            $sql .= " and wewenang = '$wewenang'";
        }
        $result = $this->_db->Exec($sql);
        if (empty($result)) {
            $sql = "select * from akun inner join anggota on anggota.email = akun.email where anggota.nra = '$email' and status = '$status'";
            if ($wewenang) {
                $sql .= " and wewenang = '$wewenang'";
            }
            $result = $this->_db->Exec($sql);
            if (empty($result)) {
                logs(__CLASS__ . ' tidak ditemukan');
                return false;
            }
        }
        $anggota = $result[0];
        $this->setEmail($anggota->email);
        $this->setPassword($anggota->password);
        $this->setNRA($anggota->nra); //*
        $this->setNamaPanggilan($anggota->namapanggilan); //*
        $this->setNamaLengkap($anggota->namalengkap);
        $this->setAngkatan($anggota->angkatan); //*
        $this->setJenisKelamin($anggota->jeniskelamin); //*
        $this->setTempatLahir($anggota->tempatlahir); //*
        $this->setTglLahir($anggota->tgllahir); //*
        $this->setNomerPonsel($anggota->nomerponsel);
        $this->setAlamatDomisili($anggota->alamatdomisili);
        $this->setWilayah($anggota->wilayah);
        $this->setPendidikanTerakhir($anggota->pendidikanterakhir); //*
        $this->setPekerjaan($anggota->pekerjaan);
        $this->setInstitusi($anggota->institusi);
        $this->setJabatan($anggota->jabatan);
        $this->setFotoVar($anggota->foto);
        $this->setStatus($anggota->status);
        $this->setWewenang($anggota->wewenang); //*
    }
    public function reset() {
        $this->setEmail('');
        $this->setPassword('');
        $this->setNRA(''); //*
        $this->setNamaPanggilan(''); //*
        $this->setNamaLengkap('');
        $this->setAngkatan(''); //*
        $this->setJenisKelamin(''); //*
        $this->setTempatLahir(''); //*
        $this->setTglLahir(''); //*
        $this->setNomerPonsel('');
        $this->setAlamatDomisili('');
        $this->setWilayah('');
        $this->setPendidikanTerakhir(''); //*
        $this->setPekerjaan('');
        $this->setInstitusi('');
        $this->setJabatan('');
        $this->setFoto(null);
        $this->setFotoVar('');
        $this->setStatus(''); //*
    }
    public function getDokumens() {
        $document = new Dokumen;
        return $document->getDokumens($this->email);
    }
}
