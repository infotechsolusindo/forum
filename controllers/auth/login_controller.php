<?php
class Login_Controller extends Controller{
	private $user;
	private	$error;

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
		if(!empty($_POST)&&isset($_POST['login-member'])){
			$this->loginMember();
		}
		if(!empty($_POST)&&isset($_POST['login-seleksi'])){
			$this->loginSeleksi();
		}

		$this->Load_View('auth/login');
		
		$this->view->Assign('error',$this->error);
		if(!empty($_POST)&&isset($_POST['login-member'])){
			$this->loginMember();
		}

	}

	private function loginMember() {
		$userid = isset($_POST['id'])?$_POST['id']:'';
		$password = isset($_POST['password'])?md5($_POST['password']):'';
		if($userid==''||$password==''){
			logs('Login error');
			echo 'Login error';
		}
		$config = [
			'id' => $userid,
			'password' => $password
		];
		$akun = new Akun();
		$akun->set($config);
		$user = $akun->getProfile();
		if($user->password !== $password){
			logs('Login gagal, Password salah');
			session_destroy();
		 	redirect(SITE_ROOT,'index');
		}
		logs('Login sukses');
		$this->setSession($user);
	}

	public function setSession($user) {
		if(!isset($_SESSION[$user->userid])){
			$_SESSION['id'] = $user->userid;
			$_SESSION['time'] = time();
			$_SESSION['nama'] = $user->nama;
			$_SESSION['email'] = $user->email;
			$_SESSION['privileges'] = $user->status!='S'?'anggota':'seleksi';
			$_SESSION['path'] = $_SESSION['privileges'].'/index';
		 	redirect(SITE_ROOT,$this->path);
		}

	}

	// public function
}
