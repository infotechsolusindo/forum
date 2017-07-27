<?php
class Index_Controller extends Controller {
    private $angkatan;
    private $tahap;
    private $pendaftaran = [];
    public function __construct() {
        parent::__construct();
        if (!checkSession()) {
            logs('Session tidak ditemukan');
            redirect(SITE_ROOT, 'index');
        }

        $header = new View();
        $header->Assign('wewenang', $_SESSION['wewenang']);
        $header->Assign('app_title', APP_TITLE);
        $header->Assign('brand', APP_NAME);
        $header->Assign('user', $_SESSION['nama']);
        $header->Assign('tabmenu', 'admin');
        $this->Assign('header', $header->Render('header', false));

        $footer = new View();
        $this->Assign('footer', $header->Render('footer', false));

        $module_sidebanner = new Module();
        $this->Assign('side_banner', $module_sidebanner->Render());
        $module_right = new Module(['members_list', 'populer', 'forum-side']);
        $this->Assign('module_right', $module_right->Render());
        $module_banner = new Module([]);
        $this->Assign('module_banner', $module_banner->Render());
        $sysconfig = new SysConfig;
        $this->angkatan = $sysconfig->getIParameter('angkatan');
        $this->tahap = $sysconfig->getIParameter('tahap');

    }

    public function index() {
        $module_main = new Module(['admin-daftarpendaftaran' /*, 'admin-daftarpeserta'*/]);
        $this->Assign('module_main', $module_main->Render());
        $this->Assign('tahap', $this->tahap);
        $this->Load_View('admin/index');
    }
    public function formulir() {
        $module_main = new Module(['karir-side']);
        $this->Assign('module_main', $module_main->Render());
        $this->Load_View('admin/index');
    }
    public function pendaftaran($action, $data) {
        $pendaftaran = new Pendaftaran;
        switch ($action) {
        case 'terima':
            $pendaftaran->setStatus($data, '1');
            $peserta = new Peserta;
            $peserta->getProfile($data);
            $v = new View;
            $v->Assign('nra', $peserta->getNRA());
            $v->Assign('namalengkap', $peserta->getNamaLengkap());
            $v->Assign('email', $peserta->getEmail());
            $body = $v->Render('email/otorisasipendaftaran', FALSE);
            $email = new Email();
            $email->to($data);
            $email->subject('Pendaftaran peserta Baru');
            $email->body($body);
            $email->sendemail();
            break;
        default:

            break;
        }
        $this->index();
    }
    public function seleksi() {
        $this->Load_View('admin/seleksi');
    }
    public function peserta($id) {
        $module_main = new Module();
        $this->Assign('module_main', $module_main->Render());
        $peserta = new Peserta;
        $peserta->getProfile($id, 'D', 's');
        $this->Assign('namalengkap', $peserta->getnamalengkap());
        $this->Assign('alamatdomisili', $peserta->getalamatdomisili());
        $this->Assign('email', $peserta->getemail());
        $this->Assign('tgllahir', $peserta->gettgllahir());
        $this->Assign('foto', $peserta->getfoto());
        $this->Assign('nra', $peserta->getnra());
        $this->Assign('angkatan', $peserta->getangkatan());
        switch ($peserta->getJenisKelamin()) {
        case 'L':
            $jk = 'Laki - laki';
            break;
        case 'P':
            $jk = 'Perempuan';
            break;
        }
        $this->Assign('jeniskelamin', $jk);
        $this->Assign('tempatlahir', $peserta->gettempatlahir());
        $this->Assign('nomerponsel', $peserta->getnomerponsel());
        $wilayah = new Wilayah;
        $w = $wilayah->getwilayah($peserta->getwilayah());
        $this->Assign('wilayah', $w[0]->nama);
        $this->Assign('pendidikanterakhir', $peserta->getpendidikanterakhir());
        $this->Assign('pekerjaan', $peserta->getpekerjaan());
        $this->Assign('institusi', $peserta->getinstitusi());
        $this->Assign('jabatan', $peserta->getjabatan());
        switch ($peserta->getstatus()) {
        case 'A':
            $status = 'Aktif';
            break;
        case 'B':
            $status = 'Di Block';
            break;
        case 'C':
            $status = 'Batal / di Hapus';
            break;
        case 'D':
            $status = 'Belum Aktif';
            break;
        }
        $this->Assign('status', $status);

        $dokumens = new Dokumen;
        $d = $dokumens->getDokumens($peserta->getEmail());
        $this->Assign('dokumens', $d);
        $this->Load_View('admin/peserta-detail');
    }
    public function generatePenilaian() {
        $tahap = $_POST['tahap'];
        $seleksi = new Seleksi;
        if ($tahap == 1) {
            $seleksi->getSemuaPendaftaran($this->angkatan);
        } else {
            $seleksi->getSemuaPendaftaran2($this->angkatan, $tahap);
        }
        // $this->Assign('penilaian', $seleksi->getSemuaPenilaian($this->angkatan, $_SESSION['id']));
        // var_dump($seleksi);
        $this->index();
    }
    public function rekapPenilaian() {

    }
}
