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
        $i = 1;
        foreach ($result as $r) {
            $this->_db->Exec("insert into penilaian value(null,0)");
            // $penilaian = $this->_db->Exec("select last_insert_id() as id from penilaian limit 1");
            $peserta = new Peserta;
            $peserta->getProfile($r->peserta, 'D', 's');
            $email = $peserta->getEmail();
            // if ($peserta->getnra() != '') {
            //     continue;
            // }
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
            // $query = $this->_db->Exec("select max(nra) as maxnra from anggota where nra like 'C-$angkatan-%' ");
            // $lastid = !is_null($query) ? $query[0]->maxnra : false;
            // logs('peserta:' . $email . ' lastid:' . $lastid);
            // if (!$lastid) {
            //     $idxnra = 1;
            // } else {
            //     $idxnra = explode('-', $lastid)[2];
            //     $idxnra++;
            // }
            // $nra = 'C-' . $angkatan . '-' . $idxnra;
            $tahapanseleksi = $this->_db->Exec("select * from tahapanseleksi where angkatan = $angkatan and tahap = $_POST[tahap]");

            $i++;
            // $this->_db->Exec("update anggota set nra = '$nra' where email = '$email'");
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
    public function getSemuaPendaftaran2($angkatan, $tahap, $kuota) {
        $sql = "select anggota.email,anggota.nra,anggota.jeniskelamin,anggota.wilayah,anggota.sdata1 as rekapnilai from pendaftaran join anggota on anggota.email = pendaftaran.peserta where pendaftaran.status = '1'";
        $result1 = $this->_db->Exec($sql);
        $i = 0;
        logs('angkatan:' . $angkatan);
        logs('tahap:' . $tahap);
        $tahapanseleksi = $this->_db->Exec("select * from tahapanseleksi where angkatan = $angkatan and tahap = $tahap");
        if ($tahap > 1) {
            if ($kuota < 1) {return (Object) ['errorMessage' => 'Kuota belum terisi'];}
            foreach ($result1 as $r) {
                logs('do:' . $r->nra);
                $this->hitungnilai($r->nra, $angkatan, $tahap - 1, $r->rekapnilai);
            }
            $result2 = $this->_db->Exec("select anggota.email,anggota.nra,anggota.jeniskelamin,anggota.wilayah,penilaian.totalnilai from penilaian join anggota on anggota.nra = penilaian.idpeserta order by totalnilai desc limit $kuota");
            $arrpesertalolos = [];
            foreach ($result2 as $r) {
                $arrpesertalolos[] = $r->email;
            }
            foreach ($result1 as $p) {
                if (in_array($p->email, $arrpesertalolos)) {continue;}
                $this->_db->Exec("update pendaftaran set status = '2' where peserta = '$p->email'");
                $this->_db->Exec("delete from penilaian where idpeserta = '$p->nra'");
            }

        }

        foreach ($result2 as $r) {
            // $this->_db->Exec("insert into penilaian value(null,0)");
            // $penilaian = $this->_db->Exec("select last_insert_id() as id from penilaian limit 1");
            $i++;
            foreach ($tahapanseleksi as $ts) {
                $data = [
                    'tgl' => date('Y-m-d'),
                    'angkatan' => $angkatan,
                    'idpeserta' => $r->nra,
                    'jeniskelamin' => $r->jeniskelamin,
                    'wilayah' => $r->wilayah,
                    'tahap' => $ts->tahap,
                    'item' => $ts->item,
                    'idjuri' => $ts->juri,
                ];
                $this->_db->create($data, 'update');
            }
        }
        return (Object) ['successMessage' => "Berhasil generate $i penilaian untuk tahap $tahap"];
    }
    private function hitungnilai($idpeserta, $angkatan, $tahap, $rekapnilai = null) {
        $arrnilai = json_decode($rekapnilai, true);
        if (!is_array($arrnilai)) {
            $arrnilai = [];
        }
        $sql = "select sum(nilai) as total from seleksi where angkatan = $angkatan and tahap = $tahap and idpeserta = '$idpeserta'";
        $result = $this->_db->Exec($sql);
        $total = $result[0]->total;
        $arr[$tahap] = $total;
        $arrnilai = $arrnilai + $arr;
        $sdata = json_encode($arrnilai);
        $this->_db->Exec("update anggota set sdata1 = '$sdata' where nra = '$idpeserta'");
        $this->_db->Exec("insert into penilaian(idpeserta,totalnilai) value('$idpeserta',$total)  on duplicate key update totalnilai = $total");
        return;
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
        $pesertas = $this->_db->Exec("select peserta as email from pendaftaran where status = '1'");
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
