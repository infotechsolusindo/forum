<?php
class Index_Controller extends Controller {
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
    }

    public function index() {
        $module_main = new Module(['admin-daftarpendaftaran', 'admin-daftarpeserta']);
        $this->Assign('module_main', $module_main->Render());
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

}
