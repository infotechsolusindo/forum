<?php
class Index_Controller extends Controller {
	private $errors = [];
	private $success;

	public function __construct() {
		parent::__construct();
		$header = new View();
		$header->Assign('app_title', APP_TITLE);
		$header->Assign('brand', APP_NAME);
		$header->Assign('user', isset($_SESSION['nama']) ? $_SESSION['nama'] : '');
		$header->Assign('tabmenu', 'beranda');
		$this->Assign('header', $header->Render('header', false));

		$footer = new View();
		$this->Assign('footer', $header->Render('footer', false));

		$side_banner = !isset($_SESSION['id']) ? ['login-seleksi', 'login-member'] : ['members_list'];
		$module_sidebanner = new Module($side_banner);
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
		$this->Load_View('index');
	}

	public function about($data) {
		$this->Load_View('about');
		$this->Assign('heading', 'Tentang ' . APP_NAME);
		$this->Assign('content', ' Donec id ....');
	}

	public function daftarblanko() {
		$this->Load_View('daftarblangko');
	}

	public function link($secret) {
		$akun = new Akun;
		$akun->setEmail($_GET['email']);
		if ($akun->checkSecret($secret)) {
			logs('Link benar');
			$_SESSION['email'] = $akun->getEmail();
			$this->pendaftaran2($akun->getEmail());
		} else {
			session_destroy();
			$this->Load_View('error');
		}
	}

	public function pendaftaran1() {
		$akun = new Akun;
		$this->Load_View('pendaftaran1');
		if (isset($_GET['cmd']) == 'save') {
			$akun->setEmail($_POST['email']);
			$akun->setPassword($_POST['password']);
			// Validation
			//Cek email kosong atau kurang dari 6 karakter
			if (isset($_POST['email']) && ($_POST['email'] === '' || strlen($_POST['email']) < 6)) {
				$this->errors['email'] = 'Email tidak boleh kosong !';
			}
			//Cek password kosong
			if (isset($_POST['password']) && ($_POST['password'] == '')) {
				$this->errors['password'] = 'Password tidak boleh kosong !';
			}
			//Cek konfirmasi password
			if (!$akun->verifyPassword($_POST['konfirmasi'])) {
				$this->errors['password'] = 'Konfirmasi password harus sama dengan password !';
			}
			if (empty($this->errors)) {
				$result = $akun->simpanAkun();
				if (!is_object($result)) {
					// Send Email
					$link = SITE_ROOT . DS . "?url=index/link/" . $akun->getSecret() . "&email=" . $akun->getEmail();
					$v = new View;
					$v->Assign('link', $link);
					$body = $v->Render('email/pendaftaran1', FALSE);

					$emailtocapaska = new Email();
					$emailtocapaska->to($akun->getEmail());
					$emailtocapaska->subject('Permintaan Pendaftaran Baru');
					$emailtocapaska->body($body);
					$emailtocapaska->sendemail();

					$this->Assign('successMessage', 'Pendaftaran berhasil. Silahkan menunggu email dari kami');
					$akun->setEmail('');
				} else {
					$this->errors[$result->errno] = $result->error;
				}
			}
		}
		$this->Assign('errorMessage', $this->errors);
		$this->Assign('akun', $akun);
	}

	public function pendaftaran2($email) {
		if (!(isset($_SESSION['email']) && $_SESSION['email'] === $email)) {
			redirect(SITE_ROOT);
		}
		$this->Load_View('pendaftaran2');
		session_destroy();
	}

}
