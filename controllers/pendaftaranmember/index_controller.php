<?php
class Index_Controller extends Controller {
    private $errors = [];
    private $success;
    private $anggota;
    public function __construct() {
        parent::__construct();
        $header = new View();
        $header->Assign('wewenang', $_SESSION['wewenang']);
        $header->Assign('app_title', APP_TITLE);
        $header->Assign('brand', APP_NAME);
        $header->Assign('user', isset($_SESSION['nama']) ? $_SESSION['nama'] : '');
        $header->Assign('tabmenu', 'beranda');
        $this->Assign('header', $header->Render('header', false));

        $footer = new View();
        $this->Assign('footer', $header->Render('footer', false));

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
    }

    public function index() {
        $anggota = new Anggota;
        $anggota->getProfile($_SESSION['id'], 'M');
        if ($anggota->getEmail() == '') {
            logs('Data anggota belum ada. Isi biodata');
            $anggota->setEmail($_SESSION['id']);
            $this->step1($anggota);
            return;
        } else {
            logs('Data anggota tersedia. Lanjut ke step2');
            $pendaftaran = new Pendaftaran;
            $result = $pendaftaran->getPendaftaran($anggota);
            if (empty($result)) {
                $this->anggota = $anggota;
                $this->step2();
                return;
            }
            redirect(SITE_ROOT, 'seleksi/index');
            // $this->Load_View('seleksi/index');
        }
    }

    private function step1(Anggota $anggota) {
        if (isset($_GET['cmd']) == 'save') {
            // Validation
            // Cek email tidak valid
            $akun = new Akun;
            $akun->setEmail($_POST['email']);
            if (!$akun->getAkun('n')) {
                $this->Assign('error', 'Maaf data Anda tidak ditemukan. Mungkin Anda belum mendaftar');
                $this->Load_View('error');
                return;
            }
            //Cek email kosong atau kurang dari 6 karakter
            if (isset($_POST['email']) && ($_POST['email'] === '' || strlen($_POST['email']) < 6)) {
                $this->errors['email'] = "Email kosong";
            }
            //Cek field nama lengkap terisi atau tidak
            if (isset($_POST['namalengkap']) && $_POST['namalengkap'] == '') {
                $this->errors['namalengkap'] = "Nama lengkap tidak boleh kosong";
            }
            //Cek field jenis kelamin terisi atau tidak
            if (isset($_POST['jeniskelamin']) && $_POST['jeniskelamin'] == '') {
                $this->errors['jeniskelamin'] = "Jenis kelamin tidak boleh kosong";
            }
            if (isset($_FILES['foto'])) {
                if ($_FILES['foto']['name'] == '') {
                    $fotofile = '';
                } else {
                    $fotofile = $_FILES['foto'];
                }
            }
            $this->Assign('jeniskelaminselect', $_POST['jeniskelamin']);
            $this->Assign('wilayahselect', $_POST['wilayah']);
            $this->Assign('pendidikanterakhirselect', $_POST['pendidikanterakhir']);
            //Jika tidak ada error
            $anggota->setEmail($_POST['email']);
            // $anggota->setNRA($_POST['nra']);
            $anggota->setNamaPanggilan($_POST['namapanggilan']);
            $anggota->setNamaLengkap($_POST['namalengkap']);
            $anggota->setAngkatan(date('Y')); // Angkatan dikunci berdasarkan tahun sekarang
            $anggota->setJenisKelamin($_POST['jeniskelamin']);
            $anggota->setTempatLahir($_POST['tempatlahir']);
            $anggota->setTglLahir($_POST['tgllahir']);
            $anggota->setNomerPonsel($_POST['telp']);
            $anggota->setAlamatDomisili($_POST['alamatdomisili']);
            $anggota->setWilayah($_POST['wilayah']);
            $anggota->setPendidikanTerakhir($_POST['pendidikanterakhir']);
            // $anggota->setPekerjaan($_POST['pekerjaan']);
            $anggota->setInstitusi($_POST['institusi']);
            // $anggota->setJabatan($_POST['jabatan']);
            $anggota->setFoto($fotofile);
            if (empty($this->errors)) {
                logs('Tidak ada error, proses request');
                $anggota->setStatus('M');
                $result = $anggota->simpanAnggota();
                if (is_object($result) && isset($result->error)) {
                    $this->errors[] = $result->error;
                    $anggota->getProfile($_POST['email'], 'M');
                } else {
                    $this->anggota = $anggota;
                    return $this->step2();
                }
            }
        } else {
            $this->Assign('jeniskelaminselect', '');
            $this->Assign('wilayahselect', '');
            $this->Assign('pendidikanterakhirselect', '');
        }
        $wilayah = new Wilayah;
        $this->Assign('wilayah', $wilayah->getWilayah());
        $this->Assign('errorMessage', $this->errors);
        $this->Assign('member', $anggota);
        $this->Load_View('pendaftaranmember/step1');
    }

    private function step2() {
        if ($this->anggota->getWewenang() == 'n') {
            $this->anggota->setWewenang('n2');
            $this->anggota->update();
            // var_dump($this->anggota);
            $v = new View;
            $body = $v->Render('email/pendaftaran2', FALSE);
            $emailtoanggota = new Email();
            $emailtoanggota->to($this->anggota->getEmail());
            $emailtoanggota->subject('Panita Pendaftaran anggota');
            $emailtoanggota->body($body);
            $emailtoanggota->sendemail();

            $nraanggota = $this->anggota->getNRA();
            $namalengkapanggota = $this->anggota->getNamaLengkap();
            $emailanggota = $this->anggota->getEmail();
            $v->Assign('nra', $nraanggota);
            $v->Assign('email', $emailanggota);
            $v->Assign('namalengkap', $namalengkapanggota);
            $body = $v->Render('email/pendaftaran2admin', FALSE);
            $emailtoadmin = new Email();
            $emailtoadmin->to(MAIL_ADMIN);
            $emailtoadmin->subject('Pendaftaran ulang anggota lama');
            $emailtoadmin->body($body);
            $send = $emailtoadmin->sendemail();
            logs($send);
        }
        $this->Load_View('pendaftaran/stepmember2');
    }

    public function dokumen($action, $id) {
        switch ($action) {
        case 'hapus':
            $dokumen = new Dokumen;
            $dokumen->hapus($id);
            break;

        default:
            # code...
            break;
        }
        return $this->index();
    }
}
