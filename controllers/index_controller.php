<?php
class Index_Controller extends Controller{

	public function __construct() {
		parent::__construct();
		$header = new View();
		$header->Assign('app_title',APP_TITLE);
		$header->Assign('brand',APP_NAME);
		$header->Assign('user',isset($_SESSION['nama'])?$_SESSION['nama']:'');
		$header->Assign('tabmenu','beranda');
		$this->Assign('header',$header->Render('header',false));

		$footer = new View();
		$this->Assign('footer',$header->Render('footer',false));

		$side_banner = !isset($_SESSION['id'])?['login-seleksi','login-member']:['members_list'];
		$module_sidebanner = new Module($side_banner);
		$this->Assign('side_banner',$module_sidebanner->Render());
		$module_left = new Module(/*['karir-side','links-side']*/);
		$this->Assign('module_left',$module_left->Render());
		$module_right = new Module(/*['populer','forum-side']*/);
		$this->Assign('module_right',$module_right->Render());
		$module_banner = new Module(/*['banner']*/);
		$this->Assign('module_banner',$module_banner->Render());
		$module_main = new Module(/*['artikel-terbaru']*/);
		$this->Assign('module_main',$module_main->Render());
	}

	public function index() {
		$this->Load_View('index');
	}

	public function about($data) {
		$this->Load_View('about');
		$this->Assign('heading','Tentang ' . APP_NAME);
		$this->Assign('content',' Donec id ....');
	}

	public function daftarblanko(){
		$this->Load_View('daftarblangko');
	}


	public function pendaftaran() {
		$error = false;
		$capaska = new Peserta();
		$this->Load_View('seleksi/pendaftaran');
		if(isset($_GET['cmd'])=='save') {
			// Validation
			//Cek email kosong atau kurang dari 6 karakter
			if(isset($_POST['email']) && ($_POST['email']===''||strlen($_POST['email'])<6)) $error = true;
			//Cek password kosong
			if(isset($_POST['password']) && ($_POST['password']=='')) $error = true;
			//Cek konfirmasi password
			if(!$capaska->verifyPassword($_POST['password'],$_POST['konfirmasi'])) $error = true;
			//Cek field jenis kelamin terisi atau tidak
			if(isset($_POST['jeniskelamin'])&&$_POST['jeniskelamin']=='') $error = true;

			//Jika tidak ada error
			if(!$error) {
                                logs('Tidak ada error, proses request');
				$capaska->setEmail($_POST['email']);
				$capaska->setPassword($_POST['password']);
				$capaska->setNRA($_POST['nra']);
				$capaska->setNamaPanggilan($_POST['namapanggilan']);
				$capaska->setNamaLengkap($_POST['namalengkap']);
				$capaska->setAngkatan($_POST['angkatan']);
				$capaska->setJenisKelamin($_POST['jeniskelamin']);
				$capaska->setTempatLahir($_POST['tempatlahir']);
				$capaska->setTglLahir($_POST['tgllahir']);
				$capaska->setNomerPonsel($_POST['telp']);
				$capaska->setAlamatDomisili($_POST['alamatdomisili']);
				$capaska->setPendidikanTerakhir($_POST['pendidikanterakhir']);
				$capaska->setPekerjaan($_POST['pekerjaan']);
				$capaska->setInstitusi($_POST['institusi']);
				$capaska->setJabatan($_POST['jabatan']);
				$capaska->setFoto($_FILES['foto']);

				$pendaftaran = new Pendaftaran();
                                
				$pendaftaran->tambahPeserta($capaska);
				if(isset($_FILES['berkas'])){
                                        $berkas = [];
				        $i = 1;
                                        foreach ($_FILES['berkas']['name'] as $name) {
                                            $berkas[$i]['name'] = $name;
                                            $i++;
                                        }
				        $i = 1;
                                        foreach ($_FILES['berkas']['type'] as $type) {
                                            $berkas[$i]['type'] = $type;
                                            $i++;
                                        }
				        $i = 1;
                                        foreach ($_FILES['berkas']['tmp_name'] as $tmpname) {
                                            $berkas[$i]['tmpname'] = $tmpname;
                                            $i++;
                                        }
				        $i = 1;
                                        foreach ($_FILES['berkas']['error'] as $error) {
                                            $berkas[$i]['error'] = $error;
                                            $i++;
                                        }
				        $i = 1;
                                        foreach ($_FILES['berkas']['size'] as $size) {
                                            $berkas[$i]['size'] = $size;
                                            $i++;
                                        }
                                        $i = 1;
                                        foreach($berkas as $b){
                                                $file_name = $b['name'];
                                                $arrfile = explode('.',$file_name);
                                                $file_ext = strtolower(end($arrfile));
                                                $file_tmp = $b['tmpname'];
                                                $fullpath = ROOT.'/public/data/berkas/'.$file_name;
                                                move_uploaded_file($file_tmp,$fullpath);

						$dokumen = new Dokumen;
						$dokumen->setTipe($i);
						$dokumen->setJudul($_POST['judulfile'][$i]);
						$dokumen->setDeskripsi($_POST['deskripsifile'][$i]);
						$dokumen->setFile($fullpath);
						$pendaftaran->tambahdokumen($dokumen);
						$i++;
                                        }
				}
				$pendaftaran->simpanPendaftaran();
                                
				$emailtocapaska = new Email();
				$emailtocapaska->to($capaska->getEmail());
				$emailtocapaska->subject('Panita Pendaftaran Capaska');
				$body = "
					<p>
			<b>Selamat</b>, pendaftaran Anda berhasil. Dokumen pendaftaran Anda akan direview oleh Panitia Pendaftaran.<br>
			Mohon bersabar, kami akan segera menghubungi via email jika data Pendaftaran Anda telah kami review.
					</p>
				";
				$emailtocapaska->body($body);
				$emailtocapaska->sendemail();
				
				$emailtoadmin = new Email();
				$emailtoadmin->to(MAIL_ADMIN);
				$emailtoadmin->subject('Pendaftaran Capaska Baru');
				$body = "
                                        <p>
                                            <b>Notifikasi Pendaftaran Capaska</b><br>
                                            NRA = $capaska->getNRA() <br>
                                            Nama Lengkap = $capaska->getNamaLengkap()<br>
                                            Email = $capaska->getEmail();
                                        </p>
				";
				$emailtoadmin->body($body);
                                $emailtoadmin->sendemail();
                                 
			}
			// $this->Assign('errorMessage',$capaska->getErrors());
		}
			$this->Assign('capaska',$capaska);
	}

}
