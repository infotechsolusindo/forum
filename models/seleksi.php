<?php
class Seleksi extends Model {
    public $angkatan;
    public $wilayah;
    public $tahap;
    private $peserta;
    private $pesertas = [];
    private $aturan = [];
    private $pendaftaran = [];
    private $dataseleksi = [];
    private $juri = [];
    function __construct() {
        $database = DB_ENGINE;
        $this->_db = new $database;
        $this->_db->setTable('seleksi');
    }
    public function tambahSeleksi(Peserta $peserta) {
        // $pendaftaran = new Pendaftaran;
        // if ($pendaftaran->verify($peserta)) {
        $tahapanseleksi = new TahapanSeleksi();
        $tahapanseleksi->setAngkatan($this->angkatan);
        $wilayah = new Wilayah;
        $wilayah->setWilayah($peserta->wilayah);
        foreach ($tahapanseleksi->getDaftar($this->angkatan) as $ts) {
            $seleksi = [
                'tgl' => date('Y-m-d'),
                'angkatan' => $angkatan,
                'wilayah' => $wilayah,
                'tahap' => $ts->tahap,
                'item' => $ts->item,
                'idpeserta' => $peserta->getEmail(),
                'jeniskelamin' => $peserta->getJenisKelamin(),
            ];
        }
        $this->dataseleksi[] = $seleksi;
        // } else {
        // logs('Peserta tidak berhak untuk ikut seleksi');
        // return false;
        // }
    }

    public function setAturan(TahapanSeleksi $tahapan, AdminSeleksi $admin) {
        $this->aturan = $aturan;
    }

    public function getSemuaPendaftaran($angkatan) {
        $admin = new AdminSeleksi;
        $admin->getAdminProfile($_SESSION['id']);
        $juri = $admin->getEmail();
        $sql = "select * from pendaftaran where status = '1'";
        $result = $this->_db->Exec($sql);
        $nra = '';
        $i = 1;
        foreach ($result as $r) {
            $peserta = new Peserta;
            $peserta->getProfile($r->peserta, 'D', 's');
            $email = $peserta->getEmail();
            if ($peserta->getnra() != '') {
                continue;
            }
            if ($peserta->getWewenang() != 's') {
                continue;
            }

            if ($peserta->getAngkatan() != $angkatan) {
                continue;
            }
            if ($peserta->getWilayah() != $_POST['wilayah']) {
                continue;
            }
            // switch ($_POST['jeniskelamin']) {
            // case 'L':if ($peserta->getJenisKelamin() !== 'L');
            //     continue;
            //     break;
            // case 'P':if ($peserta->getJenisKelamin() !== 'P');
            //     continue;
            //     break;
            // case 'S':if ($peserta->getJenisKelamin() !== 'L' || $peserta->getJenisKelamin() !== 'P');
            //     continue;
            //     break;
            // }
            // $cekStatusSeleksi = $this->_db->Exec("select * from seleksi where peserta = '$email' and tahap = $_POST[tahap] and idpenilaian <> null");
            // if (!empty($cekStatusSeleksi)) {
            //     continue;
            // }
            $query = $this->_db->Exec("select max(nra) as maxnra from anggota where nra like 'C-$angkatan-%' ");
            $lastid = !is_null($query) ? $query[0]->maxnra : false;
            var_dump($query);
            logs('peserta:' . $email . ' lastid:' . $lastid);
            if (!$lastid) {
                $idxnra = 1;
            } else {
                $idxnra = explode('-', $lastid)[2];
                $idxnra++;
            }
            $nra = 'C-' . $angkatan . '-' . $idxnra;
            $tahapanseleksi = $this->_db->Exec("select * from tahapanseleksi where juri = '$juri' and angkatan = $angkatan and tahap = $_POST[tahap]");

            $i++;
            $this->_db->Exec("update anggota set nra = '$nra' where email = '$email'");
            foreach ($tahapanseleksi as $ts) {
                $data = [
                    'tgl' => date('Y-m-d'),
                    'angkatan' => $angkatan,
                    'idpeserta' => $nra,
                    'jeniskelamin' => $peserta->getJenisKelamin(),
                    'wilayah' => $peserta->getWilayah(),
                    'tahap' => $ts->tahap,
                    'item' => $ts->item,
                    'idjuri' => $juri,
                ];
                $this->_db->create($data);
            }
        }

    }
    public function getSemuaPenilaian($angkatan = null, $peserta = null, $juri = null) {
        $sql = "select * from seleksi ";
        if ($angkatan) {
            $option[] = "angkatan = $angkatan";
        }
        if ($peserta) {
            $option[] = "idpeserta = '$peserta'";
        }
        if ($juri) {
            $option[] = "idjuri = '$juri'";
        }
        $where = ' where ' . join(" and ", $option);
        return $this->_db->Exec("select * from seleksi $where");

    }
    public function tambahJuri(Juri $juri) {
        $this->juri[$juri->getTugasJuri()] = $juri;
    }
    public function getPesertas($status) {
        $pesertas = $this->_db->Exec("select * from anggota where status = '$status'");
        foreach ($pesertas as $p) {
            $peserta = new Peserta;
            $peserta->getProfile($p->email, $status);
            $this->pesertas[] = $peserta;
        }
        return $this->pesertas;
    }
    public function updateNilai($idpeserta, $angkatan, $juri, $tahap, $item, $nilai) {
        $sql = "update seleksi set nilai = $nilai where idpeserta = '$idpeserta' and angkatan = $angkatan and idjuri = '$juri' and tahap = $tahap and item = '$item'";
        return $this->_db->Exec($sql);
    }

}
