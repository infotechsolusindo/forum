<?php
class Spool_Model extends Model
{
	function __construct()
	{
		logs(get_class($this));
		$classname = DB_ENGINE;
		$this->_db = new $classname();
		$this->tbname = '_spool';
	}

	public function getAllNew(){
		$datas = $this->_db->Exec('SELECT * FROM '.$this->tbname.' WHERE status = "0" ORDER BY ctime',null,'silent');
		$sql = [];
		foreach ($datas as $data) {
			$sql[] = $data->id;
		}
		$joinsql = 'UPDATE '.$this->tbname.' SET status="1" WHERE id IN('.implode(",", $sql).')';
		$this->_db->Exec($joinsql,null,'silent');
		return $datas;
	}
	public function setProcess($id){
		return $this->_db->Exec('UPDATE '.$this->tbname.' SET status="1" WHERE id='.$id,null,'silent');
	}
	public function setDone($id){
		return $this->_db->Exec('UPDATE '.$this->tbname.' SET status="2" WHERE id='.$id,null,'silent');
	}
	public function setError($id){
		return $this->_db->Exec('UPDATE '.$this->tbname.' SET status="3" WHERE id='.$id,null,'silent');
	}
	public function reset($id){
		return $this->_db->Exec('UPDATE '.$this->tbname.' SET status="0" WHERE id='.$id,null,'silent');
	}
}
