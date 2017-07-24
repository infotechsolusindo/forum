<?php
class Forum_Controller extends Controller {
    private $errors = [];
    private $success;

    public function __construct() {
        parent::__construct();
        if (!checkSession()) {
            logs('Session tidak ditemukan');
            session_destroy();
            redirect(SITE_ROOT, 'index');
        }
        $header = new View();
        if (isset($_SESSION['wewenang'])) {
            $header->Assign('wewenang', $_SESSION['wewenang']);
        }

        $header->Assign('app_title', APP_TITLE);
        $header->Assign('brand', APP_NAME);
        $header->Assign('user', isset($_SESSION['nama']) ? $_SESSION['nama'] : '');
        $header->Assign('tabmenu', 'forum');
        $this->Assign('header', $header->Render('header', false));

        $footer = new View();
        $this->Assign('footer', $header->Render('footer', false));

        $side_banner = !isset($_SESSION['id']) ? ['login-seleksi', 'login-member'] : ['members_list'];

        $module_sidebanner = new Module();
        $this->Assign('side_banner', $module_sidebanner->Render());
        $module_left = new Module(['karir-side']/*['karir-side','links-side']*/);
        $this->Assign('module_left', $module_left->Render());
        $module_right = new Module($side_banner/*['populer','forum-side']*/);
        $this->Assign('module_right', $module_right->Render());
        $module_banner = new Module( /*['banner']*/);
        $this->Assign('module_banner', $module_banner->Render());
        $module_main = new Module(['daftar-artikel']);
        $this->Assign('module_main', $module_main->Render());
    }

    public function index() {
        $thread = new ArtikelFactory;
        $this->Assign('list', $thread->getArtikelsThread());
        $this->Load_View('forum/index');
    }
    public function detail($id) {
        $artikel = new Artikel($id);
        $artikel->getJudul();
        var_dump($artikel);die;
    }
    public function tambah() {
        $this->Load_View('forum/thread_form');
    }
    public function simpan() {
        $tipe = $_POST['tipe'];
        switch ($tipe) {
        case '1':
            $this->simpanThread();
            break;
        case '2':
            $this->simpanKarir();
            break;
        case '3':
            $this->simpanKegiatan();
            break;
        default:
            redirect(SITE_ROOT . '?url=anggota/forum');
            break;
        }
        return;
    }
    private function simpanThread() {
        $judul = $_POST['judul'];
        $isipanjang = $_POST['isi'];
        $isipendek = strlen($isipanjang) > 0 ? substr($isipanjang, 0, 255) : '';
        $penulis = $_SESSION['id'];
        $topik = '';
        $filename = '';
        $thread = new Thread;
        if (strlen($_POST['topikbaru']) > 0) {
            $topik = $thread->newtopik($_POST['topikbaru']);
        } else {
            if ($_POST['idtopik'] == "") {
                $error = "Topik belum dipilih";
            } else {
                $topik = $_POST['idtopik'];
            }
        }
        if ($_FILES['gambar']['name'] != '' || $_FILES['gambar']['size'] > 0 && $_FILES['gambar']['size'] < 2000000) {
            $filename = $thread->uploadFile($_FILES['gambar']);
        }
        $data = [
            'tglposting' => date('Y-m-d'),
            'judul' => $judul,
            'isipendek' => $isipendek,
            'isipanjang' => $isipanjang,
            'penulis_email' => $penulis,
            'idtopik' => $topik,
            'status' => '0',
            'tipe' => '1',
            'gambar' => $filename,
        ];
        if ($error !== '') {redirect(SITE_ROOT . '?url=anggota/forum/tambah');}
        $thread->simpan($data);
        redirect(SITE_ROOT . '?url=anggota/forum');
    }
    private function simpanKarir() {}
    private function simpanKegiatan() {}

}
