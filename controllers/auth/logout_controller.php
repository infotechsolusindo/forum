<?php
class Logout_Controller extends Controller{

	public function __construct() {
		parent::__construct();
	}

	function index() {
		if(isset($_SESSION)){
			logs('Destroy all sessions');
			session_destroy();
		}
		redirect(SITE_ROOT,'index');
	}
}
