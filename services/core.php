<?php
define('DS', '/');
define('ROOT', DS . 'www' . DS . 'forum.localhost' . DS);
function logs($msg) {
    date_default_timezone_set(TIME_ZONE);
    $date = date('d/m/Y h:i:s a', time());
    $msg = '[' . $date . '] ' . $msg;
    // echo debug_print_backtrace();
    error_log($msg . PHP_EOL, 3, ROOT . DS . 'tmp' . DS . 'logs' . DS . 'service_log');
}
