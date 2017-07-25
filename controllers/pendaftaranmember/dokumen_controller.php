<?php
/**
 *
 */
class Dokumen_Controller extends Controller {

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
}