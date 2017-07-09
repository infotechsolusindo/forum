<?php
class Index_Controller extends Controller {
	private $errors = [];
	private $success;
	private $peserta;
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
		$peserta = new Peserta;
		$peserta->getProfile($_SESSION['id'], 'D');
		if ($peserta->getEmail() == '') {
			logs('Data anggota belum ada. Isi biodata');
			$peserta->setEmail($_SESSION['id']);
			$this->step1($peserta);
			return;
		} else {
			logs('Data anggota tersedia. Lanjut ke step2');
			$pendaftaran = new Pendaftaran;
			$result = $pendaftaran->getPendaftaran($peserta);
			if (empty($result)) {
				$this->peserta = $peserta;
				$this->step2();
				return;
			}
			redirect(SITE_ROOT, 'seleksi/index');
			// $this->Load_View('seleksi/index');
		}
	}

	private function step1(Peserta $peserta) {
		if (isset($_GET['cmd']) == 'save') {
			// Validation
			// Cek email tidak valid
			$akun = new Akun;
			$akun->setEmail($_POST['email']);
			if (!$akun->getAkun('p')) {
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
			$peserta->setEmail($_POST['email']);
			$peserta->setNRA($_POST['nra']);
			$peserta->setNamaPanggilan($_POST['namapanggilan']);
			$peserta->setNamaLengkap($_POST['namalengkap']);
			$peserta->setAngkatan(date('Y')); // Angkatan dikunci berdasarkan tahun sekarang
			$peserta->setJenisKelamin($_POST['jeniskelamin']);
			$peserta->setTempatLahir($_POST['tempatlahir']);
			$peserta->setTglLahir($_POST['tgllahir']);
			$peserta->setNomerPonsel($_POST['telp']);
			$peserta->setAlamatDomisili($_POST['alamatdomisili']);
			$peserta->setWilayah($_POST['wilayah']);
			$peserta->setPendidikanTerakhir($_POST['pendidikanterakhir']);
			$peserta->setPekerjaan($_POST['pekerjaan']);
			$peserta->setInstitusi($_POST['institusi']);
			$peserta->setJabatan($_POST['jabatan']);
			$peserta->setFoto($fotofile);
			if (empty($this->errors)) {
				logs('Tidak ada error, proses request');
				$result = $peserta->simpanAnggota();
				if (is_object($result) && isset($result->error)) {
					$this->errors[] = $result->error;
					$peserta->getProfile($_POST['email'], 'D');
				} else {
					$this->peserta = $peserta;
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
		$this->Assign('peserta', $peserta);
		$this->Load_View('pendaftaran/step1');
	}

	private function step2() {
		$dokumens = [];
		if (isset($_GET['cmd']) && $_GET['cmd'] == 'save2') {
			$pendaftaran = new Pendaftaran();
			$pendaftaran->tambahPeserta($this->peserta);
			$i = 1;
			foreach ($_FILES['berkas']['name'] as $key => $name) {
				$berkas[$key]['name'] = trim($name);
			}
			$i = 1;
			foreach ($_FILES['berkas']['type'] as $key => $type) {
				$berkas[$key]['type'] = $type;
				$i++;
			}
			$i = 1;
			foreach ($_FILES['berkas']['tmp_name'] as $key => $tmpname) {
				$berkas[$key]['tmpname'] = $tmpname;
				$i++;
			}
			$i = 1;
			foreach ($_FILES['berkas']['error'] as $key => $error) {
				$berkas[$key]['error'] = $error;
				$i++;
			}
			$i = 1;
			foreach ($_FILES['berkas']['size'] as $key => $size) {
				$berkas[$key]['size'] = $size;
				$i++;
			}
			foreach ($berkas as $key => $b) {
				if ($b['name'] == '') {
					continue;
				}
				if (strlen($b['name']) > 30) {
					$this->errors[] = "Nama file berkas $key terlalu panjang ($b[name])";
					continue;
				}
				$file_name = $b['name'];
				$arrfile = explode('.', $file_name);
				$file_ext = strtolower(end($arrfile));
				$file_tmp = $b['tmpname'];
				$fullpath = ROOT . '/public/data/berkas/' . md5($this->peserta->getEmail()) . '-file-' . $key . '.' . $file_ext;
				move_uploaded_file($file_tmp, $fullpath);

				$dokumen = new Dokumen;
				$dokumen->setTipe($key);
				$dokumen->setJudul($_POST['judulfile'][$key]);
				$dokumen->setDeskripsi($_POST['deskripsifile'][$key]);
				$dokumen->setNamaFile($file_name);
				$dokumen->setFile($fullpath);
				$pendaftaran->tambahdokumen($dokumen);
			}
			$result = $pendaftaran->simpanPendaftaran();
			foreach ($result as $r) {
				$this->errors[$r->errno] = $r->error;
			}
		}
		$angkatan = date('Y');
		$daftar = new DaftarDokumen;
		$daftars = $daftar->getDaftar($angkatan);
		$dok = $this->peserta->getDokumens();
		foreach ($dok as $d) {
			$dokumens[$d->tipe] = $d;
		}
		if (empty($result) && (count($dok) == count($daftars))) {
			logs('Data sudah komplit, lanjut ke step3');
			return $this->step3();
		}
		$this->Assign('daftar', $daftars);
		$this->Assign('dokumen', $dokumens);
		$this->Assign('errorMessage', $this->errors);
		$this->Load_View('pendaftaran/step2');
	}

	private function step3() {
		if ($this->peserta->getWewenang() == 'p') {
			$this->peserta->setWewenang('s');
			$this->peserta->update();
			// var_dump($this->peserta);
			$v = new View;
			$body = $v->Render('email/pendaftaran2', FALSE);
			$emailtopeserta = new Email();
			$emailtopeserta->to($this->peserta->getEmail());
			$emailtopeserta->subject('Panita Pendaftaran peserta');
			$emailtopeserta->body($body);
			$emailtopeserta->sendemail();

			$nrapeserta = $this->peserta->getNRA();
			$namalengkappeserta = $this->peserta->getNamaLengkap();
			$emailpeserta = $this->peserta->getEmail();
			$v->Assign('nra', $nrapeserta);
			$v->Assign('email', $emailpeserta);
			$v->Assign('namalengkap', $namalengkappeserta);
			$body = $v->Render('email/pendaftaran2admin', FALSE);
			$emailtoadmin = new Email();
			$emailtoadmin->to(MAIL_ADMIN);
			$emailtoadmin->subject('Pendaftaran peserta Baru');
			$emailtoadmin->body($body);
			$send = $emailtoadmin->sendemail();
                        logs($send);
		}
		$this->Load_View('pendaftaran/step3');
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
