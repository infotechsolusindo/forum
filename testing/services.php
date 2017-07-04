<?php
define('DS','/');
define('ROOT','/www/forum.localhost/');
include ROOT.'/config/config.php';
include ROOT.'/library/controller.php';
include ROOT.'/library/database.php';
include ROOT.'/library/model.php';
include ROOT.'/library/mysql.php';
require ROOT.'/models/akun.php';
require ROOT.'/models/anggota.php';
require ROOT.'/models/ianggota.php';
require ROOT.'/models/admin.php';
require ROOT.'/models/iadmin.php';
require ROOT.'/models/adminforum.php';
require ROOT.'/models/adminseleksi.php';
require ROOT.'/models/juri.php';

require ROOT.'/models/artikel.php';
require ROOT.'/models/iartikel.php';
require ROOT.'/models/aturanseleksi.php';
require ROOT.'/models/dokumen.php';
require ROOT.'/models/formulir.php';
require ROOT.'/models/forum.php';
require ROOT.'/models/ikomen.php';
require ROOT.'/models/karir.php';
require ROOT.'/models/kegiatan.php';
require ROOT.'/models/komen.php';
require ROOT.'/models/komenkarir.php';
require ROOT.'/models/komenkegiatan.php';
require ROOT.'/models/komenthread.php';
require ROOT.'/models/managemenforum.php';
require ROOT.'/models/pendaftaran.php';
require ROOT.'/models/peserta.php';
require ROOT.'/models/seleksi.php';
require ROOT.'/models/thread.php';

function logs($message){
	echo $message.PHP_EOL;
}

class Spool extends Model {
    private $procname;

    function __construct(){
        $database = DB_ENGINE;
        $this->_db = new $database;
        $this->_db->setTable('_spool');
    }
    public function setProcName($name){
        $this->procname = $name;
    }
    public function getTask($status){
        $sql = "select * from _spool where ";
        if($status !== ''){
            $sql .= "procname = '$this->procname' and ";
        }
        $sql .= "status = '$status' order by ctime asc limit 1";
        $result = $this->_db->Exec($sql);
        if(empty($result)) return false;
        return $result[0]->id;
    }
    public function setTask($id,$status){
        $result = $this->_db->Exec("update _spool set status = '$status' where id = $id");
    }
}

$procname = 'email';
$spool = new Spool;
$spool->setProcName($procname);
while($id = $spool->getTask('0')){
    logs('Task ID: '.$id.' found');
    $spool->setTask($id,'1');
    logs('Execute it (1)');
    sleep(1);
} 
