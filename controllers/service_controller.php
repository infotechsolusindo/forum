<?php
class Service_Controller extends Controller
{
	public function __construct(){
		global $log_type ;
		date_default_timezone_set('Asia/Jakarta');
		$log_type = 2;
		$this->Load_Model('Service');
	}

	public function test() {
		$mail = new Email;
		$mail->to('infotech.solusindo@gmail.com');
		$mail->subject('Testing email');
		$mail->body('coba lagi');
		$mail->sendemail();
		/*
		// var_dump($mail);
		// $mail->sendemail();
		// if(is_object($mail)){
		// 	echo 'ini object';
		// }*/
	}
	public function init(){
		$init = $this->model->getInitServiceStatus();
		logs('Init:'.$init[0]->status);
		if($init[0]->status == '0'){
			$this->model->setInitServiceStatus('1');
		} else if($init[0]->status == '3'){
			$this->model->setInitServiceStatus('0');
			return;
		}
		$this->run();
		sleep(1);
		$this->init();
	}
	public function run(){
		$success = false;
		$spools = $this->model->getSpools();
		foreach ($spools as $spool) {
			switch ($spool->procname) {
				case 'email':
					/*Process Email*/
					$status = true;
					/* End Process Email */
					if($status){
						$this->model->setSpoolDone($spool->id);
					}else{
						/* If not expired yet, add again to spool */
						$this->model->resetSpool($spool->id);
					}
					break;
				
				default:
					# code...
					break;
			}
		}
		return;
	}
/*
	public function init(){
		$list=[];
		$key=false;
		$i=0;
		$flag='';
		$last='';

		$this->Load_Model('Service');
		$this->model->setInitServiceStatus('1');
		// logs('Status: '.$init[0]->status);
		for(;;){
			$init = $this->model->getInitServiceStatus();
			if($init[0]->status!='0') {
				//$this->loop();
				if($init[0]->status=='3') exit;
			}
			$nano = time_nanosleep(0, 100000);

			if ($nano === true) {
			    //echo "Slept for 2 seconds, 100 microseconds.\n";
			} elseif ($nano === false) {
			    echo "Sleeping failed.\n";
			} elseif (is_array($nano)) {
			    $seconds = $nano['seconds'];
			    $nanoseconds = $nano['nanoseconds'];
			    echo "Interrupted by a signal.\n";
			    echo "Time remaining: $seconds seconds, $nanoseconds nanoseconds.";
			}
			$arrservices = $this->model->getServices();
			foreach ($arrservices as $service) {

				$function = $service->name;
				if($service->status=='3'){
					$this->model->setServiceStop($function);
					echo '-->'.$last.PHP_EOL;
				}
				if($service->status=='1'){
					echo 'Service:'.$function.' stop('.date('Y-m-d h:m:s').')'.PHP_EOL;
					$last = 'Service:'.$function.' stop('.date('Y-m-d h:m:s').')'.PHP_EOL;
					$this->$function();
					if(!in_array($function,$list)){
						 $list[] =	$function;
					}
				}

				$nano = time_nanosleep(0, 100000);

				if ($nano === true) {
				    //echo "Slept for 2 seconds, 100 microseconds.\n";
				} elseif ($nano === false) {
				    echo "Sleeping failed.\n";
				} elseif (is_array($nano)) {
				    $seconds = $nano['seconds'];
				    $nanoseconds = $nano['nanoseconds'];
				    echo "Interrupted by a signal.\n";
				    echo "Time remaining: $seconds seconds, $nanoseconds nanoseconds.";
				}
			}
		}
	}
*/
	public function pool(){
		echo 'halo bram'.PHP_EOL;
	}

	public function loop(){
		logs('cek pool sekarang');
	}
}