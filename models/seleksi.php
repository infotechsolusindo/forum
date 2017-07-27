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
        // $admin = new AdminSeleksi;
        // $admin->getAdminProfile($_SESSION['id']);
        // $juri = $admin->getEmail();
        $sql = "select * from pendaftaran where status = '1'";
        $result = $this->_db->Exec($sql);
        $nra = '';
        $i = 1;
        foreach ($result as $r) {
            $this->_db->Exec("insert into penilaian value(null,0)");
            $penilaian = $this->_db->Exec("select last_insert_id() as id from penilaian limit 1");
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
            //if ($peserta->getWilayah() != $_POST['wilayah']) {
            //    continue;
            //}
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
            logs('peserta:' . $email . ' lastid:' . $lastid);
            if (!$lastid) {
                $idxnra = 1;
            } else {
                $idxnra = explode('-', $lastid)[2];
                $idxnra++;
            }
            $nra = 'C-' . $angkatan . '-' . $idxnra;
            $tahapanseleksi = $this->_db->Exec("select * from tahapanseleksi where angkatan = $angkatan and tahap = $_POST[tahap]");

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
                    'idjuri' => $ts->juri,
                    'idpenilaian' => (int) $penilaian[0]->id,
                ];
                $this->_db->create($data);
            }
        }

    }
    public function getSemuaPendaftaran2($angkatan, $tahap) {
        $sql = "select * from pendaftaran where status = '1'";
        $result = $this->_db->Exec($sql);
        $nra = '';
        $i = 1;
        foreach ($result as $r) {
            $email = $r->peserta;
            $n = $this->_db->Exec("select * from anggota where email = '$email'");
            $peserta = $n[0];
            $tahapanseleksi = $this->_db->Exec("select * from tahapanseleksi where angkatan = $angkatan and tahap = $tahap");
            $this->_db->Exec("insert into penilaian value(null,0)");
            $penilaian = $this->_db->Exec("select last_insert_id() as id from penilaian limit 1");

            $i++;
            foreach ($tahapanseleksi as $ts) {
                $data = [
                    'tgl' => date('Y-m-d'),
                    'angkatan' => $angkatan,
                    'idpeserta' => $peserta->nra,
                    'jeniskelamin' => $peserta->jeniskelamin,
                    'wilayah' => $peserta->wilayah,
                    'tahap' => $ts->tahap,
                    'item' => $ts->item,
                    'idjuri' => $ts->juri,
                    //'idpenilaian' => (int) $penilaian[0]->id,
                ];
                $this->_db->create($data, 'update');
            }
        }
        $this->_db->Exec("update _config set parmival = $tahap where parmname = 'tahap'");
    }
    public function cekNilaiTahapSebelumnya($idpeserta, $tahap) {
        if ($tahap <= 1) {return;}
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
    public function updateHasil($idpeserta, $angkatan, $tahap) {
        $allseleksi = "select sum(nilai) as jumlah,(select count(*) from tahapanseleksi where angkatan = $angkatan ) as total, idpenilaian from seleksi where idpeserta = '$idpeserta' and angkatan = $angkatan and tahap = $tahap group by idpenilaian";
        $resseleksi = $this->_db->Exec($allseleksi);
        if (!empty($resseleksi)) {
            $jumlah = $resseleksi[0]->jumlah;
            logs($jumlah);
            $total = $resseleksi[0]->total;
            logs($total);
            $rata = $jumlah / $total;
            logs($rata);
            $idpenilaian = $resseleksi[0]->idpenilaian;
            return $this->_db->Exec("insert into penilaian value($idpenilaian,'$idpeserta',$rata) on duplicate key update totalnilai = $rata");
        }
    }
    public function hasilPenilaian($angkatan, $tahapan) {
        $datatahap = [];
        foreach ($tahapan as $t) {
            $sql = "select distinct idpeserta,totalnilai from seleksi join penilaian on penilaian.id = seleksi.idpenilaian where angkatan = $angkatan and tahap = $t->tahap";
            $rtahap = $this->_db->Exec($sql);
            foreach ($rtahap as $dt) {
                $datatahap[$dt->idpeserta][$t->tahap] = $dt->totalnilai;
            }

        }
        return $datatahap;
    }
}
