<?php
/** Check if environment is development and display errors **/
function SetReporting() {
	if (DEVELOPMENT_ENVIRONMENT == true) {
		error_reporting(E_ALL);
		ini_set('display_errors', 'On');
	} else {
		error_reporting(E_ALL);
		ini_set('display_errors', 'Off');
		ini_set('log_errors', 'On');
		ini_set('error_log', ROOT . DS . 'tmp' . DS . 'logs' . DS . 'error.log');
	}
}

/** Check for Magic Quotes and remove them **/
function stripSlashesDeep($value) {
	$value = is_array($value) ? array_map('stripSlashesDeep', $value) : stripslashes($value);
	return $value;
}

function RemoveMagicQuotes() {
	if (get_magic_quotes_gpc()) {
		$_GET = stripSlashesDeep($_GET);
		$_POST = stripSlashesDeep($_POST);
		$_COOKIE = stripSlashesDeep($_COOKIE);
	}
}

/** Check register globals and remove them **/
function UnregisterGlobals() {
	if (ini_get('register_globals')) {
		$array = array('_SESSION', '_POST', '_GET', '_COOKIE', '_REQUEST', '_SERVER', '_ENV', '_FILES');
		foreach ($array as $value) {
			foreach ($GLOBALS[$value] as $key => $var) {
				if ($var === $GLOBALS[$key]) {
					unset($GLOBALS[$key]);
				}
			}
		}
	}
}

//Automatically includes files containing classes that are called
function __autoload($className) {
	global $path;
//fetch file
	// logs('Open '.$className.' class');
	if (file_exists(ROOT . DS . 'controllers' . DS . $path . strtolower($className) . '.php')) {
		require_once ROOT . DS . 'controllers' . DS . $path . strtolower($className) . '.php';
		return;
		// logs('Register Class: '.strtolower($className).' in file :'.PHP_EOL
		//     .ROOT . DS . 'controllers' . DS . $path . strtolower($className) . '.php');
	} else if (file_exists(ROOT . DS . 'models' . DS . strtolower($className) . '.php')) {
		require_once ROOT . DS . 'models' . DS . strtolower($className) . '.php';
		return;
		// logs('Register Class: '.strtolower($className).' in file :'.PHP_EOL
		//     .ROOT.DS.'models'.DS.strtolower($className).'.php');
	} else if (file_exists(ROOT . DS . 'library' . DS . strtolower($className) . '.php')) {
		require_once ROOT . DS . 'library' . DS . strtolower($className) . '.php';
		return;
		//logs('Get all Library Class');
	} else {
		$classfound = false;
		$it = new RecursiveDirectoryIterator(ROOT . DS . 'vendor');
		foreach (new RecursiveIteratorIterator($it) as $file) {
			if (!is_file($file)) {
				continue;
			}

			if (pathinfo($file, PATHINFO_EXTENSION) != 'php') {
				continue;
			}

			$tokens = token_get_all(file_get_contents($file));
			foreach ($tokens as $token) {
				if (!is_array($token)) {
					continue;
				}

				if (token_name(intval($token[0])) == 'T_CLASS') {
					$classfound = true;
					continue;
				}
				if ($classfound && in_array($className, $token)) {
					require_once $file;
					return;
				} else {continue;}
			}
		}
		if (!$classfound) {
			// Error: Controller Class not found
			// redirect(SITE_ROOT,'auth/error');
			die("Error: Class not found.");
		}
	}
	logs('End Load=================================================');
}

/** Main Call Function **/
function CallHook() {
	global $url, $path;
	$path = '';
	$tmp = '';
	$controllerName = null;
	$action = DEFAULT_ACTION;
	$query1 = null;
	$query2 = null;
	if (!isset($url)) {
		$controllerName = DEFAULT_CONTROLLER;
		$action = DEFAULT_ACTION;
	} else {
		logs($url);
		$urlArray = array();
		$urlArray = explode("/", $url);
		$tmp = ROOT . DS . 'controllers' . DS . $urlArray[0];
		if (file_exists($tmp) && is_dir($tmp)) {
			$path = $urlArray[0] . DS;
			$controllerName = $urlArray[1];
			$action = (isset($urlArray[2]) && $urlArray[2] != '') ? $urlArray[2] : DEFAULT_ACTION;
			$query1 = (isset($urlArray[3]) && $urlArray[3] != '') ? $urlArray[3] : null;
			$query2 = (isset($urlArray[4]) && $urlArray[4] != '') ? $urlArray[4] : null;
		} else if (file_exists($tmp . '_controller.php') && is_file($tmp . '_controller.php')) {
			$controllerName = $urlArray[0];
			$action = (isset($urlArray[1]) && $urlArray[1] != '') ? $urlArray[1] : DEFAULT_ACTION;
			$query1 = (isset($urlArray[2]) && $urlArray[2] != '') ? $urlArray[2] : null;
			$query2 = (isset($urlArray[3]) && $urlArray[3] != '') ? $urlArray[3] : null;
		}
	}

//modify controller name to fit naming convention
	$class = ucfirst($controllerName) . '_Controller';
	logs('URL :' . $url);
	logs('Controller Name: ' . ucfirst(substr($path, 0, -1)) . '\\' . $class);
	logs('Action Name: ' . $action);
	logs('Query1 : ' . $query1);
	logs('Query2 : ' . $query2);
	logs('=====================================================');

//instantiate the appropriate class
	if (class_exists($class) && (int) method_exists($class, $action)) {
		$controller = new $class;
		$controller->$action($query1, $query2);
//call_user_func_array(array($controller,$action),$query1);
	} else {
//Error: Controller Class not found
		die("1. File <strong>'$controllerName.php'</strong> containing class <strong>'$class'</strong> might be missing. <br>2. Method <strong>'$action'</strong> is missing in <strong>'$controllerName.php'</strong>");
	}
}

function redirect($url, $action = null, $message = null) {
	$address = explode("://", $url);
	$protocol = $address[0] == 'https' ? 'https' : 'http';
	$action = isset($action) || $action === '' ? '/?url=' . $action : '';
	$_SESSION['message'] = $message;
	echo 'Location: ' . $protocol . '://' . $address[1] . $action;
	logs('Location: ' . $protocol . '://' . $address[1] . $action);
	return header('Location: ' . $protocol . '://' . $address[1] . $action, true, 302);
}

function logs($msg) {
	global $log_type;
	$type = $log_type;
	if (!$msg == '' && $type == 0) {
		date_default_timezone_set(TIME_ZONE);
		$date = date('d/m/Y h:i:s a', time());
		$msg = '[' . $date . '] ' . $msg;
		// echo debug_print_backtrace();
		error_log($msg . PHP_EOL, 3, ROOT . DS . 'tmp' . DS . 'logs' . DS . 'access_log');
	} else if (!$msg == '' && $type == 2) {
		date_default_timezone_set(TIME_ZONE);
		$date = date('d/m/Y h:i:s a', time());
		$msg = '[' . $date . '] ' . $msg;
		// echo debug_print_backtrace();
		error_log($msg . PHP_EOL, 3, ROOT . DS . 'tmp' . DS . 'logs' . DS . 'service_log');
	}
}

function checkSession() {
	/* BYPASS LOGIN */
	// return true;
        logs('Check this session');
	if (!isset($_SESSION['id'])) {
            logs('Error: Session tidak ditemukan');
	    return false;
	}
	$user = new Anggota;
	$user->getProfile($_SESSION['id'], 'A');
        if($user->getEmail()==''){
            logs('Error: user tidak berhak atau tidak terdaftar di sistem!');
            return false;
        }
	switch ($user->getWewenang()) {
	case '0':
		$wewenang = 'anggota';
		break;
	case '1':
		$wewenang = 'admin';
		break;
	case '2':
		$wewenang = 'juri';
		break;
	case '3':
		$wewenang = 'admin_seleksi';
		break;
	case '4':
		$wewenang = 'admin_forum';
		break;
	default:
		return false;
		break;
	}
	logs('W:' . $user->getWewenang() . ' ' . $wewenang);
	if (isset($_SESSION['privileges'])) {
		if ($_SESSION['privileges'] !== $wewenang) {
			return false;
		}

	} else {
		return false;
	}
	// if(isset($_GET['url'])){
	//     $url = $_GET['url'];
	//     $actions = explode('/',$url);
	//     if($actions[0]!=$_SESSION['privileges']){
	//         return false;
	//     }
	// }
	return true;
}

function getLoggedUser($field) {
//     if(!isset($_SESSION['id'])||$_SESSION['id']==''){
	//         return false;
	//     }
	//     if($field == 'fullname'){
	//         return $_SESSION['fullname'];
	//     }
	//     if($field == 'email'){
	//         return $_SESSION['email'];
	//     }
	//     if($field == 'address'){
	//         return $_SESSION['address'];
	//     }
	//     if($field == 'phone'){
	//         return $_SESSION['phone'];
	//     }
}

logs(PHP_EOL . PHP_EOL);
logs('///////////////////////////////////////////');
logs('Starting app ...');
session_start();

SetReporting();
RemoveMagicQuotes();
UnregisterGlobals();
CallHook();
