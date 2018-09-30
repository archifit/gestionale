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
}

?>