<?php
class Error_Controller extends Controller {

    public function __construct() {
        parent::__construct();
        $this->privileges = isset($_SESSION['privileges']) ? $_SESSION['privileges'] . '/' : null;
    }

    public function index() {
        if (!isset($_SESSION['id'])) {
            redirect(SITE_ROOT, 'auth/logout');
        }
        logs('error');
        $this->Load_View('error');
    }
}
