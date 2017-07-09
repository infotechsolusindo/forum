<?php
define('DS', '/');
define('ROOT', '/www/forum.localhost/');
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
