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

    public function logout() {
    	// Initialize the session.
    	// If you are using session_name("something"), don't forget it now!
    	session_start();

    	// Unset all of the session variables.
    	$_SESSION = array();

    	// If it's desired to kill the session, also delete the session cookie.
    	// Note: This will destroy the session, and not just the session data!
    	if (ini_get("session.use_cookies")) {
    		$params = session_get_cookie_params();
    		setcookie(session_name(), '', time() - 42000,
    				$params["path"], $params["domain"],
    				$params["secure"], $params["httponly"]
    				);
    	}

    	// Finally, destroy the session.
    	session_destroy();
    }
}

// definisce la variabile session
$session = new _Session();
?>