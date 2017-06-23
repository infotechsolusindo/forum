<?php
/**
* 
*/
class Database
{
	protected $_conn;
	private $host;
	private $user;
	private $password;
	private $db;
	
	public function __construct()
	{
		$this->host 	= HOST;
		$this->user 	= USERNAME;
		$this->password = PASSWORD;
		$this->db 		= DB;
		$this->_conn = $this->connect();
	}

    protected function connect() {
    	// return 'connection';
    }

	protected function Exec($sql)
	{
		// return 'access query';
	}

}