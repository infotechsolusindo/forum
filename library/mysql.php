<?php
/**
* 
*/
class Mysql extends Database
{
	protected $connection;
	private $host;
	private $user;
	private $password;
	private $db;
	public $_table;
    private $_pk;

	function __construct()
	{
		$this->host 	= HOST;
		$this->user 	= USERNAME;
		$this->password = PASSWORD;
		$this->db 	= DB;
        $this->connection = self::connect();
        mysqli_report(MYSQLI_REPORT_STRICT);
	}
    /**
     * Set Table and Default Key
     */
    public function setTable($table,$pk='id'){
        logs($pk);
        $this->_table = $table;
        $this->_pk = $pk;
    }
    public function getData($id){
        return $this->getById($id,$this->_table,$this->_pk,$options=null);     
    }
    public function getDatas($kriteria,callable $callable){
        var_dump($callable);
        $tmpwhere = "";
        if(!empty($kriteria)){
            foreach ($kriteria as $key => $value) {
                $value = gettype($value)=='integer'?$value:'"'.$value.'"';
                $tmpwhere .= ' '.$key.'='.$value;
            }
            $where = "WHERE $tmpwhere";
        }
        return $this->Exec("SELECT * FROM $this->_table $where");
    }

    function connect() {

        // Define connection as a static variable, to avoid connecting more than once 
        static $connection;

        // Try and connect to the database, if a connection has not been established yet
        if(!isset($connection)) {
             // Load configuration as an array. Use the actual location of your configuration file
            $connection = mysqli_connect($this->host,$this->user,$this->password,$this->db);
        }

        // If connection was not successful, handle the error
        if($connection === false) {
            // Handle error - notify administrator, log to a file, show an error screen, etc.
            logs(mysqli_connect_error());
            return mysqli_connect_error(); 
        }
        return $connection;
    }

    function Exec($sql,$action=null,$mode=null){
        $data = [];
        if(!$mode) logs('SQL:'.$sql);
        $result = mysqli_query($this->connection,$sql);
        if(is_object($result)){
            if(isset($action)=='length'){
                return mysqli_num_rows($result);
            }
            while($row=mysqli_fetch_assoc($result)){
                $data[] = (Object) $row;
            }
            return $data;
            mysqli_free_result($result);
        }
        return $result;
    }

    function getById($id,$table,$pk,$options=null){
        $result;
        $limit = "LIMIT 1";
        $page = '';
        $fields = [];
        // $id = "'$id'";
        if(!is_null($options)){
            if(is_array($options)){
                foreach ($options as $key => $value) {
                    if($key == 'fields'){ $fields = $value; }
                    if($key == 'page'){
                        $start = 0;
                        $page = $value>1?$value:1;
                        if($page){
                            $start = ($page - 1) * PAGE_LENGTH;
                        }
                        $limit = 'LIMIT '.$start.','.PAGE_LENGTH; 
                    }
                    if($key == 'limit'){
                        $limit = $value==0?'':"LIMIT $value";
                    }
                    if($key == 'pktype'){
                        $id = $value == 'char'?"$id":$id;
                    }
                }
            }
        }
        $data = [];
        $i = 0;
        $vfields = "*";
        if(isset($fields) && ! empty($fields)){
            $vfields = implode(",", $fields);
        }

        $sql = "SELECT $vfields FROM $table WHERE $pk = '$id' $limit";
        logs($sql);
        try{
            if(!($result = mysqli_query($this->connection,$sql))){
                throw new Exception("Error doing query : \"".$sql."\"");
            }
        }
        catch(Exception $e){
            logs($e->getMessage());
            die();
        }

        if($limit == 'LIMIT 1'){
            
            try{
                if($data = (Object) mysqli_fetch_assoc($result)){
                    mysqli_free_result($result);
                    return $data;                
                } else {
                    throw new Exception("Data tidak ditemukan", 1);
                }
            } catch(Exception $e){
                logs($e->getMessage());
                die();
            }
        } else {
            while($row=mysqli_fetch_assoc($result)){
                $data[] = (Object) $row;
            }
            $result->data = $data;
            $result->page = $page>1?$page:1;
            $res = $this->Exec("SELECT count(*) AS total FROM $table");

            $total = $res[0]->total;
            $mod = $total % PAGE_LENGTH;
            $last = $mod>0?floor($total/PAGE_LENGTH)+1:floor($total/PAGE_LENGTH);
            logs('Jumlah Halaman:'.floor($total/PAGE_LENGTH));

            $result->firstpage = 1;
            $result->lastpage = $last;
            $result->prevpage = ($result->page > 1) ? $result->page - 1 : 1;
            $result->nextpage = ($result->page < $result->lastpage)?$result->page + 1:$result->page;

            return $result;
        }
        return;
    }

    /**********************************************************
     * Insert data into table:
     *   table  : current working table
     *   inputs : array of datas (and its fields)
     *      Ex:
     *        [ 'name' => 'jhon doe', 'age' => 31 ]
     *   type   : array of type of fields (optional)
     *      Ex:
     *        [ 'name' => 'char', 'age' => int ]
     *
     ********************************************************** */
    public function create($table,$inputs,$type=null){
        $fields = '';
        $data = '';
        $i = 0;
        foreach ($inputs as $key => $value) {
            $i++;
            logs($i.':'.count($inputs));
            logs('Data:'.$key.'=>'.$value);
            $comma = $i < count($inputs)?',':'';
            $fields .= $key . $comma;
            if(isset($type[$key])&&($type[$key]=='char')){
                $data .= '\'' . $value . '\'' . $comma;
            } else if(isset($type[$key])&&($type[$key]=='int')) {
                $data .= ' ' . $value . ' ' . $comma;
            } else {
                $data .= '\'' . $value . '\'' . $comma;                
            }
        }
        $sql = "INSERT INTO $table ";
        $sql .= "($fields) ";
        $sql .= "VALUE($data)";
        logs($sql);
        return $this->Exec($sql);
    }

    /**********************************************************
     * Update certain data in table:
     *   id	: identifier or key of data
     *   table  : current working table
     *   inputs : array of datas (and its fields)
     *      Ex:
     *        [ 'name' => 'jhon doe', 'age' => 31 ]
     *   type   : array of type of fields (optional)
     *      Ex:
     *        [ 'name' => 'char', 'age' => int ]
     *
     ********************************************************** */
    public function update($id,$table,$inputs,$type=null){
        $fields = '';
        $data = '';
        $i = 0;
        $where = '';
        // var_dump($inputs);
        foreach ($inputs as $key => $value) {
            $i++;
            // $where .= "$key = $value";

            logs($i.':'.count($inputs));
            logs('Data:'.substr($key.'=>'.$value,0,250));
            $comma = $i < count($inputs)?',':'';

            if(isset($type[$key])&&($type[$key]=='char')){
                $fields .= ' '.$key.' = \'' . $value . '\' ' . $comma;
            } else if(isset($type[$key])&&($type[$key]=='int')) {
                $fields .= ' '.$key.' = ' . $value . ' ' . $comma . ' ';
            } else {
                $fields .= '\'' . $value . '\'' . $comma;                
            }

            $where = $id['type']=='char'?"$id[name] = '$id[value]'":"$id[name] = $id[value]";
        }
        $sql = "UPDATE $table ";
        $sql .= "SET $fields ";
        $sql .= "WHERE $where";
        logs($sql);
        return $this->Exec($sql);
    }

    public function getAll($length=0,$page=1,$altsql=null,$pk=null){
    	$table = $this->_table;
        $result = (Object) Array();
        $start = 0;
        if($page){
            $start = ($page - 1) * $length;
        }
        $i=0;
        $sql = "SELECT * FROM $table";
        if(isset($altsql)){
            switch ($altsql) {
                case 'asc':
                        $sql .= " ORDER BY $pk ASC";
                    break;
                case 'desc':
                        $sql .= " ORDER BY $pk DESC";
                    break;
                default:
                    $sql = $altsql;
                    break;
            }
        }
    	$sql .= " LIMIT $start";
    	$sql .= $length>0?",$length":"";
        $result->data = $this->Exec($sql);

        $result->page = $page>1?$page:1;
        $res = $this->Exec("SELECT count(*) AS total FROM $table");

        $total = $res[0]->total;
        $result->num = $total;

        $mod = $total % PAGE_LENGTH;
        $last = $mod>0?floor($total/PAGE_LENGTH)+1:floor($total/PAGE_LENGTH);
        logs('Jumlah Halaman:'.floor($total/PAGE_LENGTH));

        $result->firstpage = 1;
        $result->lastpage = $last;
        $result->prevpage = ($result->page > 1) ? $result->page - 1 : 1;
        $result->nextpage = ($result->page < $result->lastpage)?$result->page + 1:$result->page;
        return $result;
    }

    public function getOne($sql){
        logs($sql);
        try{
            if(!($result = mysqli_query($this->connection,$sql))){
                throw new Exception("Error doing query : \"".$sql."\"");
            }
        }
        catch(Exception $e){
            logs($e->getMessage());
            die();
        }
        try{
            if($data = (Object) mysqli_fetch_assoc($result)){
                mysqli_free_result($result);
                return $data;                
            } else {
                throw new Exception("Data tidak ditemukan", 1);
            }
        } catch(Exception $e){
            logs($e->getMessage());
            die();
        }
        return;
    }

    public function getFirst($table,$fields=[],$byorder=null){
        $arrfield='*';
        if(!empty($fields)){
            $arrfield = join(',',$fields);
        }
        if(!empty($byorder)){
            $by = "ORDER BY ";
            foreach ($byorder as $key => $order) {
                $by .= " $key $order ";
            }
        } else {
            $by = "ORDER BY created ASC";
        }

        $sql = "SELECT $arrfield,created FROM $table $by LIMIT 1";
        logs($sql);
        try{
            if(!($result = mysqli_query($this->connection,$sql))){
                throw new Exception("Error doing query : \"".$sql."\"");
            }
        }
        catch(Exception $e){
            logs($e->getMessage());
            die();
        }
        try{
            if($data = (Object) mysqli_fetch_assoc($result)){
                mysqli_free_result($result);
                return $data;                
            } else {
                throw new Exception("Data tidak ditemukan", 1);
            }
        } catch(Exception $e){
            logs($e->getMessage());
            die();
        }
        return;
    }

    public function getLast($table,$fields=[],$byorder=null){
        $arrfield = "*";
        if(!empty($fields)){
            $arrfield = join(',',$fields);
        }
        if(!empty($byorder)){
            $by = "ORDER BY ";
            foreach ($byorder as $key => $order) {
                $by .= " $key $order ";
            }
        } else {
            $by = "ORDER BY created DESC";
        }

        $sql = "SELECT $arrfield,created FROM $table $by LIMIT 1";
        logs($sql);
        try{
            if(!($result = mysqli_query($this->connection,$sql))){
                throw new Exception("Error doing query : \"".$sql."\"");
            }
        }
        catch(Exception $e){
            logs($e->getMessage());
            die();
        }
        try{
            if($data = (Object) mysqli_fetch_assoc($result)){
                mysqli_free_result($result);
                return $data;                
            } else {
                throw new Exception("Data tidak ditemukan", 1);
            }
        } catch(Exception $e){
            logs($e->getMessage());
            die();
        }
        return;
    }

    public function getNext($id,$table,$field,$typepk=null){
        logs('getNext');
        if(isset($typepk)){
            if($typepk == 'char'){
                $id = "'$id'";
            }
        }

        $sql = "SELECT * FROM $table WHERE $field > $id LIMIT 1";
        logs($sql);
        try{
            if(!($result = mysqli_query($this->connection,$sql))){
                throw new Exception("Error doing query : \"".$sql."\"");
            }
        }
        catch(Exception $e){
            logs($e->getMessage());
            die();
        }
        try{
            if($data = (Object) mysqli_fetch_assoc($result)){
                mysqli_free_result($result);
                return $data;                
            } else {
                throw new Exception("Data tidak ditemukan", 1);
            }
        } catch(Exception $e){
            logs($e->getMessage());
            die();
        }
        return;
    }

    public function getPrev($id,$table,$field,$typepk=null){
        if(isset($typepk)){
            if($typepk == 'char'){
                $id = "'$id'";
            }
        }

        $sql = "SELECT * FROM $table WHERE $field < $id LIMIT 1";
        logs($sql);
        try{
            if(!($result = mysqli_query($this->connection,$sql))){
                throw new Exception("Error doing query : \"".$sql."\"");
            }
        }
        catch(Exception $e){
            logs($e->getMessage());
            die();
        }
        try{
            if($data = (Object) mysqli_fetch_assoc($result)){
                mysqli_free_result($result);
                return $data;                
            } else {
                throw new Exception("Data tidak ditemukan", 1);
            }
        } catch(Exception $e){
            logs($e->getMessage());
            die();
        }
        return;
    }

    public function remove($id,$table,$pk,$typepk=null){
        if(isset($typepk)){
            if($typepk == 'char'){
                $id = "'$id'";
            }
        }
        $sql = "DELETE FROM $table WHERE $pk = $id";
        logs($sql);
        try{
            if(!($result = mysqli_query($this->connection,$sql))){
                throw new Exception("Error doing query : \"".$sql."\"");
            }
        }
        catch(Exception $e){
            logs($e->getMessage());
            die();
        }
        return;
    }
    // function getAll($table,$options=[$fields=null,$limit=null,$order='asc']){    }


}
