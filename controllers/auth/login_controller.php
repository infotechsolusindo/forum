<?php
class Login_Controller extends Controller {
	private $user;
	private $error;

	private $username;
	private $nama;
	private $email;
	// private $address;
	// private $phone;

	public function __construct() {
		parent::__construct();
		// $this->Load_Model('Akun');
	}

	public function index() {
		if (!empty($_POST) && isset($_POST['login-member'])) {
			$this->loginMember();
		}
		if (!empty($_POST) && isset($_POST['login-seleksi'])) {
			$this->loginSeleksi();
		}

		$this->Load_View('auth/login');

		$this->view->Assign('error', $this->error);
		//if(!empty($_POST)&&isset($_POST['login-member'])){
		//    $this->loginMember();
		//}

	}

	private function loginMember() {
		$userid = isset($_POST['id']) ? $_POST['id'] : '';
		$password = isset($_POST['password']) ? md5($_POST['password']) : '';
		if ($userid == '' || $password == '') {
			logs('Login error');
			echo 'Login error';
		}

		$user = new Anggota;
		$user->getProfile($userid);
		$user->getAkun();

		if ($user->getPassword() !== $password) {
			logs('Login gagal, Password salah');
			session_destroy();
			redirect(SITE_ROOT, 'index');
		}
		logs('Login sukses');
		$this->setSession($user);
	}

	private function loginSeleksi() {
		$email = isset($_POST['email']) ? $_POST['email'] : '';
		$password = isset($_POST['password']) ? md5($_POST['password']) : '';
		if ($email == '' || $password == '') {
			logs('Login error');
			// echo 'Login error';
		}

		$akun = new Peserta;
		$akun->setEmail($email);
		$akun->getAkun();
		logs('Input Password:' . $password);
		logs('DB Password:' . $akun->getPassword());
		if ($akun->getPassword() !== $password) {
			logs('Login seleksi gagal, Password salah');
			redirect(SITE_ROOT, 'auth/logout');
			return;
		}
		logs('Login seleksi sukses');
		$this->setSession($akun);
	}

	private function setSession($user) {
		switch ($user->getWewenang()) {
		case 'p':
			$_SESSION['id'] = $user->getEmail();
			$_SESSION['privileges'] = 'pendaftaran';
			break;
		case 's':
			$pendaftaran = new Pendaftaran;
			$pendaftaran->getPendaftaran($user);
			var_dump($pendaftaran->getPendaftaran($user));
			$_SESSION['id'] = $user->getEmail();
			$_SESSION['privileges'] = empty($pendaftaran->getPendaftaran($user)) ? 'pendaftaran' : 'seleksi';
			break;
		case '0':
			$_SESSION['id'] = $user->getNRA();
			$_SESSION['nama'] = $user->getNamaLengkap();
			$_SESSION['email'] = $user->getEmail();
			$_SESSION['privileges'] = 'anggota';
			break;
		case '1':
			$_SESSION['id'] = $user->getNRA();
			$_SESSION['nama'] = $user->getNamaLengkap();
			$_SESSION['email'] = $user->getEmail();
			$_SESSION['privileges'] = 'admin';
			logs('sebagai admin');
			break;
		default:
			session_destroy();
			redirect(SITE_ROOT, 'auth/logout');
			return;
			break;
		}
		$_SESSION['time'] = time();
		$_SESSION['wewenang'] = $user->getWewenang();
		$_SESSION['path'] = $_SESSION['privileges'] . '/index';
		redirect(SITE_ROOT, $_SESSION['path']);
	}

	// public function
}
