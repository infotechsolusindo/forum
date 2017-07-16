<?php
/**
 *
 */
class Index_Controller extends Controller {
    private $angkatan;
    function __construct() {
        parent::__construct();
        $header = new View();
        $header->Assign('wewenang', (isset($_SESSION['wewenang']) ? $_SESSION['wewenang'] : ''));
        $header->Assign('app_title', APP_TITLE);
        $header->Assign('brand', APP_NAME);
        $header->Assign('user', isset($_SESSION['nama']) ? $_SESSION['nama'] : '');
        $header->Assign('tabmenu', 'juri');
        $this->Assign('header', $header->Render('header', false));

        $footer = new View();
        $this->Assign('footer', $header->Render('footer', false));

        $menujuri = new View();
        $this->Assign('menujuri', $menujuri->Render('juri/menujuri', false));
        // $side_banner = !isset($_SESSION['id']) ? [] : [];
        $module_sidebanner = new Module([]);
        $this->Assign('side_banner', $module_sidebanner->Render());
        $module_left = new Module( /*['karir-side','links-side']*/);
        $this->Assign('module_left', $module_left->Render());
        $module_right = new Module( /*['populer','forum-side']*/);
        $this->Assign('module_right', $module_right->Render());
        $module_banner = new Module( /*['banner']*/);
        $this->Assign('module_banner', $module_banner->Render());
        $module_main = new Module( /*['artikel-terbaru']*/);
        $this->Assign('module_main', $module_main->Render());
        $this->angkatan = date('Y');
    }
    public function index() {
        $this->Assign('angkatan', $this->angkatan);
        $wilayah = new Wilayah;
        $this->Assign('wilayah', $wilayah->getWilayah());
        $juri = new AdminSeleksi;
        $juri->getAdminProfile($_SESSION['id']);
        $this->Assign('juri', $juri->getEmail());
        $this->Assign('namajuri', $juri->getNamaLengkap());
        // $this->penilaian();
        $this->Load_View('juri/index');
    }
    public function tampilkan() {
        $seleksi = new Seleksi;
        $seleksi->getSemuaPendaftaran($this->angkatan);
        // $this->Assign('penilaian', $seleksi->getSemuaPenilaian($this->angkatan, $_SESSION['id']));
        // var_dump($seleksi);
        $this->index();
    }

    public function penilaian() {
        $this->Assign('angkatan', $this->angkatan);
        $wilayah = new Wilayah;
        $this->Assign('wilayah', $wilayah->getWilayah());
        $juri = new AdminSeleksi;
        $juri->getAdminProfile($_SESSION['id']);
        $this->Assign('juri', $juri->getEmail());
        $this->Assign('namajuri', $juri->getNamaLengkap());

        if (isset($_GET['cmd']) && ($_GET['cmd'] == 'save')) {
            $this->penilaianSave();
        }
        $angkatan = $this->angkatan;
        $tahapan = new TahapanSeleksi;
        $tahapan->setAngkatan($angkatan);
        $juri = new AdminSeleksi;
        $juri->getAdminProfile($_SESSION['id']);
        $tahapan->setJuri($juri);
        $items = $tahapan->getTahapan();
        $pesertas = new AnggotaFactory;
        $pesertas->setAngkatan($angkatan);
        $pesertas->setStatus('D');
        $header = [
            'Wilayah',
            'No.Peserta',
            'Nama Lengkap',
        ];
        foreach ($items as $i) {
            array_push($header, $i->item);
        }
        $idtahap;
        foreach ($pesertas->getAnggotas() as $p) {
            if ($p->nra == '') {
                continue;
            }
            $wilayah = new Wilayah;
            $w = $wilayah->getWilayah($p->wilayah)[0];
            $data1 = [
                'idwilayah' => $w->id,
                'nmwilayah' => $w->nama,
                'id' => $p->nra,
                'nama' => $p->namalengkap,
            ];
            $data2 = [];

            $s = new Seleksi;
            $seleksis = $s->getSemuaPenilaian($angkatan, $p->nra, $juri->getEmail());
            foreach ($items as $i) {
                $idtahap = $i->tahap;
                logs($i->item);
                foreach ($seleksis as $seleksi) {
                    if ($i->angkatan == $seleksi->angkatan && $i->tahap == $seleksi->tahap && $i->item == $seleksi->item) {
                        $data2 += [
                            strtolower($i->item) => $seleksi->nilai,
                        ];
                    }
                }

            }
            $data = $data1 + $data2;
            $datapenilaian[] = $data;
        }
        //sort by wilayah
        array_multisort(array_map(function ($e) {
            return $e['idwilayah'];
        }, $datapenilaian), SORT_ASC, $datapenilaian);

        //end sort
        $this->Assign('tahap', $idtahap);
        $this->Assign('headerpenilaian', $header);
        $this->Assign('datapenilaian', $datapenilaian);
        $this->Load_View('juri/penilaian');
    }
    private function penilaianSave() {
        $seleksi = new Seleksi;
        $angkatan = 0;
        $tahap = '';
        $juri = '';
        foreach ($_POST as $key => $val) {
            if ($key == 'angkatan') {
                $angkatan = $val;
                continue;
            }
            if ($key == 'juri') {
                $juri = $val;
                continue;
            }
            if ($key == 'tahap') {
                $tahap = $val;
                continue;
            }
            $arr = explode('_', $key);
            $idpeserta = $arr[0];
            $item = $arr[1];
            // var_dump($idpeserta . ':' . $angkatan . ':' . $juri . ':' . $tahap . ':' . $item . ':' . $val);
            $seleksi->updateNilai($idpeserta, $angkatan, $juri, $tahap, $item, $val);
        }
        return;
    }
}