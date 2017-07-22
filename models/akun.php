<?php
class Akun extends Model {
    protected $email;
    protected $password;
    protected $wewenang;
    public function __construct() {
        $database = DB_ENGINE;
        $this->_db = new $database;
        $this->_db->setTable('akun');
    }
    public function isLogin() {
        if (isset($_SESSION['id'])) {

        }
    }
    public function setEmail($email) {
        $this->email = $email;
    }
    public function setPassword($password) {
        $this->password = $password;
        return $this;
    }
    public function setWewenang($wewenang) {
        $this->wewenang = $wewenang;
    }
    public function getEmail() {
        return $this->email;
    }
    public function getPassword() {
        return $this->password;
    }
    public function getWewenang() {
        return $this->wewenang;
    }
    public function ubahPassword($oldpassword, $newpassword) {
        return $this->_db->Exec("update akun set password = md5('$newpassword') where email = '$this->email'");
    }

    public function verifyPassword($konfirmasi) {
        if ($this->password === $konfirmasi) {
            return true;
        }

    }

    public function simpanAkun($data = null) {
        $data['created'] = date('Y-m-d h:m:s');
        $data['email'] = $this->email;
        $data['password'] = md5($this->password);
        $this->_db->setTable('akun');
        return $this->_db->create($data);
    }
    public function update() {
        logs('akun->this->password: ' . $this->password);
        $data = [
            'email' => $this->email,
            'password' => $this->password,
            'wewenang' => $this->wewenang,
        ];
        $this->_db->setTable('akun');
        return $this->_db->create($data, 'update');
    }
    public function getAkun($wewenang = '') {
        $sql = "select * from akun where email = '$this->email' ";
        if ($wewenang != '') {
            $sql .= "and wewenang = '$wewenang'";
        }
        $akun = $this->_db->Exec($sql);
        if (empty($akun)) {
            return false;
        }
        $this->password = $akun[0]->password;
        $this->wewenang = $akun[0]->wewenang;
        return true;
    }

    public function getSecret() {
        $sec = $this->_db->Exec("select * from akun where email = '$this->email' and wewenang = 'x'");
        return md5($sec[0]->email . $sec[0]->password . $sec[0]->lastmodify);
    }
    public function checkSecret($secret) {
        if ($this->getSecret() === $secret) {
            $this->_db->Exec("update akun set wewenang = 'p', lastmodify = CURRENT_TIMESTAMP where email = '$this->email' and wewenang = 'x'");
            return true;
        } else {return false;}
    }
    public function generateAkun() {
        $sql = "select * from anggota where status = 'A'";
        $result = $this->_db->Exec($sql);
        $sql = "";
        foreach ($result as $r) {
            logs('Create: '.$r->email);
            $sql = "insert ignore into akun(email,password,wewenang,created) value('$r->email',md5('123'),'0',now())";
            $result = $this->_db->Exec($sql);
        }
    }
}
