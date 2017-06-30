<?php
class Akun extends Model 
{
	protected $userid;
	protected $email;
	protected $password;
	function __construct() {
		$database = DB_ENGINE;
                $this->_db = new $database;
	}
	public function isLogin() {
		if(isset($_SESSION['id'])) {

		}
	}
	public function setEmail($email) {
		$this->email = $email;
	}
	public function setPassword($password) {
		$this->password = md5($password);
		return $this;
	}
        public function getPassword() {
                return $this->password;
        }
	public function ubahPassword($oldpassword,$newpassword) {
		return;
	}
	public function simpanAkun($data) {
		$data['created'] = date('Y-m-d h:m:s');
                $this->_db->setTable('akun');
		return $this->_db->create($data);
	}
}
