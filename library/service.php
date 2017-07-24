<?php
class Service extends Model {
    private $workers = [];

    function __construct() {
        $db = DB_ENGINE;
        $this->_db = new $db;
        $this->_db->setTable('_spool');
    }
    public function addClient(ServiceClient $client) {
        return $this->_db->Create($client->getData());
    }
    public function addWorker(ServiceWorker $worker) {
        $this->workers[$worker->name] = $worker;
    }
    public function start() {
        foreach ($this->workers as $worker) {
            $result = $this->_db->Exec("select * from _spool where procname = '$worker->name' and status = '0' limit 1", null, true);
            if (empty($result)) {
                return 'Tidak ada task';
            }

            if (isset($result->error)) {
                return $result->error;
            }
            logs('Run    :[ID=' . $result[0]->id . '],[ProcName:' . $result[0]->procname) . ']';
            $status = $result[0]->id;
            $this->_db->Exec("update _spool set status = '1' where id = $status", null, true);
            $run = $worker->run;
            $run($result[0]->data);
            logs('Finish :[ID=' . $result[0]->id . '],[ProcName:' . $result[0]->procname) . ']';
        }
        return;
    }
}

/*abstract Class Service extends Model {
abstract public function tambahService($data);
abstract public function hapusService($id);
}
 */
