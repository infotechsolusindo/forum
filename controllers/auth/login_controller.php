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
		var_dump($_POST);
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
		$config = [
			'id' => $userid,
			'password' => $password,
		];

		$akun = new Anggota;
		$akun->set($config);

		if ($akun->getPassword() !== md5($password)) {
			logs('Login gagal, Password salah');
			session_destroy();
			redirect(SITE_ROOT, 'index');
		}
		logs('Login sukses');
		$this->setSession($akun);
	}

	private function loginSeleksi() {
		$email = isset($_POST['email']) ? $_POST['email'] : '';
		$password = isset($_POST['password']) ? md5($_POST['password']) : '';
		if ($email == '' || $password == '') {
			logs('Login error');
			echo 'Login error';
		}
		$config = [
			'email' => $email,
			'password' => $password,
		];

		$akun = new Akun;
		$akun->setEmail($email);
		$akun->getAkun();

		if ($akun->getPassword() !== md5($password)) {
			logs('Login seleksi gagal, Password salah');
			session_destroy();
			redirect(SITE_ROOT, 'index');
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
			$_SESSION['id'] = $user->getEmail();
			$_SESSION['privileges'] = 'seleksi';
			break;
		case '0':
			$_SESSION['id'] = $user->getNRA();
			$_SESSION['nama'] = $user->getNamaLengkap();
			$_SESSION['email'] = $user->getEmail();
			$_SESSION['privileges'] = 'anggota';
			break;
		case '1,2,3':
			$_SESSION['id'] = $user->getNRA();
			$_SESSION['nama'] = $user->getNamaLengkap();
			$_SESSION['email'] = $user->getEmail();
			$_SESSION['privileges'] = 'admin';
			break;
		default:
			session_destroy();
			redirect(SITE_ROOT, 'index');
			break;
		}
		$_SESSION['time'] = time();
		$_SESSION['path'] = $_SESSION['privileges'] . '/index';
		redirect(SITE_ROOT, $_SESSION['path']);
	}

	// public function
}
