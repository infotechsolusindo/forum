<?php
class SQLite extends SQLite3
{
  protected $tbname;
  protected $connection;

  function __construct()
  {
    $s = DB;
    $this->open(DB);
  }

  public function connect()
  {
    static $connection;
    
    $this->connection = new SQLite();
    
    if($this->connection){
      return "Database opening success";
    } else {
      return $this->connection->lastErrorMsg();
    }
  }

  public function disconnect()
  {
    $this->close($this->connection);
  }

  public function create()
  {

  }

  public function read($data=[])
  {
    foreach($data as $d){
	
    } 
    $sql = "SELECT * from $this->tbname";
    logs($sql);
    $res = $this->query($sql);
    while($row = $res->fetchArray(SQLITE3_ASSOC)){
	
    }
  }

  public function update()
  {

  }

  public function delete()
  {
    
  }
}
