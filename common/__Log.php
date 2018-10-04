<?php
require_once __DIR__ . '/__Environment.php';
if (defined('__production_environment')) {
    
    function console_log($message, $data = "") {
    }
    function console_log_data($message, $data = "") {
    }
    function debug($message) {
    }
    function info($message) {
    }
    function warning($message) {
    }
    function error($message) {
    }
} else if (defined('__test_environment') || defined('__development_environment')) {
    require_once __DIR__ . '/Log.php';
    
    $level = PEAR_LOG_DEBUG;
    $__logger = Log::factory('file', 'd:/Temp/log/gestionale.log', '', array("timeFormat"=>"%d/%m/%Y - %H:%M:%S"), $level);
    
    function console_log($message, $data = "") {
    }
    function console_log_data($message, $data = "") {
    }
    function debug($message) {
        global $__logger;
        $page = basename ( $_SERVER ['PHP_SELF'] );
        $__logger->debug("$page: $message". ' debug');
    }
    function info($message) {
        global $__logger;
        $page = basename ( $_SERVER ['PHP_SELF'] );
        $__logger->info("$page: $message". ' info');
    }
    function warning($message) {
        global $__logger;
        $page = basename ( $_SERVER ['PHP_SELF'] );
        $__logger->warning("$page: $message". ' warning');
    }
    function error($message) {
        global $__logger;
        $page = basename ( $_SERVER ['PHP_SELF'] );
        $__logger->err("$page: $message". ' err');
    }
}

?>