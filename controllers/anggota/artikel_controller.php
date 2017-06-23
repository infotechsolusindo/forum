<?php
class Artikel_Controller extends Controller{

	public function __construct() {
		parent::__construct();
		//if(!checkSession()){
		//	logs('Session tidak ditemukan');
		// 	redirect(SITE_ROOT,'index');
		//}
		if(isset($_SESSION['path'])&&($_SESSION['path']!=='')){
			redirect(SITE_ROOT,$_SESSION['path']);
		}
		$header = new View();
		$header->Assign('app_title',APP_TITLE);
		$header->Assign('brand',APP_NAME);
		$header->Assign('user',getLoggedUser('fullname'));
		$this->Assign('header',$header->Render('header',false));

		$footer = new View();
		$this->Assign('footer',$header->Render('footer',false));

		$module_right = new Module(['members_list','karir-side','links-side','populer','forum-side']);
		$this->Assign('module_right',$module_right->Render());
		$module_banner = new Module(['banner']);
		$this->Assign('module_banner',$module_banner->Render());
		$module_main = new Module(['artikel-terbaru','artikel-form']);
		$this->Assign('module_main',$module_main->Render());
	}

	public function index() {
		$this->Load_View('anggota/artikel');
		$artikel = new Artikel_Model;
		$this->Assign('artikel',$artikel->getAll());
	}
}
