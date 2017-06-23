<?php
class Register_Controller extends Controller{
	private $table;
	private $state;
	private $username;
	private $password;
	private $password2;
	private $email;
	private $address;
	private $fullname;
	private $phone;
	private $error;

	public function __construct() {
		parent::__construct();

	}

	public function index() {
		logs('Masuk Register Controller');
		$this->Load_Model('Users');
		// $this->table = $this->model->all();
		$this->state = 'register';

		if(!empty($_POST)&&isset($_POST['register-submit'])){
			$this->username = $_POST['rusername'];
			$this->fullname = $_POST['fullname'];
			$this->email = $_POST['email'];
			$this->address = $_POST['address'];
			$this->phone = $_POST['phone'];
			$this->password = $_POST['password1'];
			$this->password2 = $_POST['password2'];
			$this->register();
		}
		logs('State:' . $this->state);
		logs('Username:' . $this->username);
		$this->Load_View('auth/login');
		
		$this->view->Set_CSS('');
		$this->view->Set_Site_Title('Sistem Analisa Penyakit');
		$this->view->Set_Meta_Keywords('sistem pakar.analisa,kesehatan');

		$this->view->Assign('error',$this->error);
		$this->view->Assign('state',$this->state);
		$this->view->Assign('rusername',$this->username);
		$this->view->Assign('fullname',$this->fullname);
		$this->view->Assign('email',$this->email);
		$this->view->Assign('address',$this->address);
		$this->view->Assign('phone',$this->phone);

		// $this->view->Set_CSS('');
		// $this->view->Set_Site_Title('Sistem Analisa Penyakit');
		// $this->view->Set_Meta_Keywords('sistem pakar.analisa,kesehatan');	
		// $header = new View();
		// $header->Assign('app_title','register::Sistem Analisa Penyakit');
		// $header->Assign('brand','e-Medical');
		// $this->Assign('header',$header->Render('header',false));

		// $footer = new View();
		// $this->Assign('footer',$header->Render('footer',false));


	}

	private function register() {
		try{
				if(isset($this->username)&&$this->username===''){
					throw new Exception("Username Kosong");
				}
				// $this->username = isset($_POST['rusername'])?isset($_POST['rusername']):"";

				if(isset($this->fullname)&&$this->fullname===''){
					// throw new Exception("Fullname Kosong");
				}
				// $this->fullname = isset($_POST['fullname'])?isset($_POST['fullname']):"";

				if(isset($this->email)&&$this->email===''){
					throw new Exception("Email Kosong");
				}
				// $this->email = isset($_POST['email'])?isset($_POST['email']):"";

				if(isset($_POST['address'])&&$_POST['address']===''){
					// throw new Exception("Alamat Kosong");
				}
				// $this->address = isset($_POST['address'])?isset($_POST['address']):"";

				if(isset($this->phone)&&$this->phone===''){
					// throw new Exception("Alamat Kosong");
				}
				// $this->phone = isset($_POST['phone'])?isset($_POST['phone']):"";

				if(isset($this->password)&&$this->password===''){
					throw new Exception("Password Kosong");
				}
				// $this->password = isset($_POST['password1'])?isset($_POST['password1']):"";

				if(isset($this->password2)&&$this->password2===''){
					throw new Exception("Konfirmasi Password Kosong");
				}
				// $this->password2 = isset($_POST['password2'])?isset($_POST['password2']):"";

				if($this->password !== $this->password2){
					throw new Exception("Konfirmasi Password Tidak Sama Dengan Password");
				}


				logs('Username :'.$this->username);
				logs('Password :'.MD5($this->password));
				logs('Password2 :'.MD5($this->password2));

				$this->table = $this->model->getUserByEmail($this->email);
				if(isset($this->table->email)){
					throw new Exception("Email ini sudah pernah terdaftar");
				}

				$this->table = $this->model->getUserByName($this->username);
				if(isset($this->table->username)){
					throw new Exception("User sudah terdaftar");
				}

				$this->save();

					// $error = 'Username atau Password Salah';
					// redirect(SITE_ROOT,'auth/logout','Password Salah');			
			} catch(Exception $e){
				logs($e->getMessage());
				$this->error = $e->getMessage();
				// $this->index();
		}
	}

	private function save() {
		$result = $this->model->addUser($this->username,$this->email,$this->password,$this->address,$this->phone);
		logs('Insert Data User:'.$result);
		return;
	}
}

