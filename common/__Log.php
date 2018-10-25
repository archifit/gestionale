<?php
require_once __DIR__ . '/__Environment.php';
if (defined('__production_environment')) {
    require_once __DIR__ . '/Log.php';

    $level = PEAR_LOG_INFO;
    $__logger = Log::factory('file', __DIR__ . '/../Log/gestionale.log', '', array("timeFormat"=>"%d/%m/%Y - %H:%M:%S"), $level);

    function console_log($message, $data = "") {
    }
    function console_log_data($message, $data = "") {
    }
    function debug($message) {
        global $__logger;
        $page = basename ( $_SERVER ['PHP_SELF'] );
        $__logger->debug("$page: $message");
    }
    function info($message) {
        global $__logger;
        $page = basename ( $_SERVER ['PHP_SELF'] );
        $__logger->info("$page: $message");
    }
    function warning($message) {
        global $__logger;
        $page = basename ( $_SERVER ['PHP_SELF'] );
        $__logger->warning("$page: $message");
    }
    function error($message) {
        global $__logger;
        $page = basename ( $_SERVER ['PHP_SELF'] );
        $__logger->err("$page: $message");
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
        $__logger->debug("$page: $message");
    }
    function info($message) {
        global $__logger;
        $page = basename ( $_SERVER ['PHP_SELF'] );
        $__logger->info("$page: $message");
    }
    function warning($message) {
        global $__logger;
        $page = basename ( $_SERVER ['PHP_SELF'] );
        $__logger->warning("$page: $message");
    }
    function error($message) {
        global $__logger;
        $page = basename ( $_SERVER ['PHP_SELF'] );
        $__logger->err("$page: $message");
    }
}

?>