<?php
class Akun extends Model {
	var $_nama;
	var $_email;
	var $_telp;
	var $_userid;
	var $_password;
    var $_status;

    function __construct(){
        $database = DB_ENGINE;
        $this->_db = new $database;
        $this->_db->setTable('users','userid');
    }
    public function set($config=[]){
        $data = $this->_db->getData($config['id']);
        $this->_nama = $data->name;
        $this->_email = $data->email;
        // $this->_telp = $data->telp;
        $this->_userid = $data->userid;
        $this->_password = $data->password;
        $this->_status = $data->status;
    }

    public function logout(){}
    public function getLoginStatus(){}
    public function ubahPassword(){}

    public function daftar(){}
    public function ubahProfile(){}
    public function getProfile(){
        $user = new stdClass();
        $user->userid = $this->_userid;
        $user->nama = $this->_nama;
        $user->email = $this->_email;
        $user->password = $this->_password;
        $user->status = $this->_status;
        return $user;
    }
    public function requestHapus(){}
}
