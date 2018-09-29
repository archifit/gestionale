<?php
class _Session {
    public function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    public function get($key) {
    	return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    public function has($key) {
        return isset($_SESSION[$key]);
    }
}

// definisce la variabile session
$session = new _Session();
?>