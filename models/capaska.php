<?php
/**
* 
*/
class Capaska extends Akun
{
	private $nama;
	private $email;
	private $telp;
	private $password;
	private $konfirmasi;
	private $errors=[];

	function __construct()
	{
		# code...
	}

	public function setNama($nama){
		$this->nama = $nama;
		if($nama=='') {
			$this->errors['nama']='<b>Nama</b> tidak boleh kosong';
			return false;
		}
		return true;
	}

	public function setEmail($email){
		$this->email = $email;
		if($email=='') {
			$this->errors['email']='<b>Email</b> tidak boleh kosong';
			return false;
		}
		$parts = explode('@',$email);
		if(empty($parts)||$parts[0]==''||$parts[1]=='') {
			$this->errors['email']='Format email belum benar';
			return false;
		}
		return true;
	}

	public function setTelp($telp){
		$this->telp = $telp;
		if($telp=""&&strlen($telp)<5) {
			$this->errors['telp']='<b>Telpon</b> yang anda masukkan salah';
			return false;
		}
		return true;
	}

	public function setPassword($password){
		if(strlen($password)<6) {
			$this->errors['password']='<b>Password</b> kurang dari 6 karekter';
			return false;
		}
		$this->password = $password;
		return true;
	}

	public function setKonfirmasi($konfirmasi){
		if($konfirmasi!==$this->password) {
			$this->errors['konfirmasi']='<b>Password</b> tidak sama dengan konfirmasi';
			return false;
		}
		$this->konfirmasi = $konfirmasi;
		return true;
	}

	public function getNama(){
		return $this->nama;
	}

	public function getEmail(){
		return $this->email;
	}
	public function getTelp(){
		return $this->telp;
	}
	public function getPassword(){
		return $this->password;
	}

	public function getErrors(){
		return $this->errors;
	}

	public function verifyPassword(){
		if($this->password !== $this->konfirmasi){
			return false;
		}
		return true;
	}
}