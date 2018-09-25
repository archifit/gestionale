<!-- start PHP code -->
<?php
session_start();

$redirect = NULL;
if($_POST['location'] != '') {
	$redirect = $_POST['location'];
}

    if(isset($_POST['user']) && !empty($_POST['user']) AND isset($_POST['password']) && !empty($_POST['password'])){
    	if(!isset($_POST['rememberme']) || empty($_POST['rememberme'])) {
    		$_POST['rememberme'] = false;
    	}
        echo $_POST['user'].'</br>'.$_POST['password'].'</br>';
        if ($_POST['rememberme']) {
        	echo 'remember';
        } else {
        	echo 'NOT remember';
        }
    }
    $_username = $_POST['user'];
    $_SESSION['utente'] = $_username;
    if($redirect !== '') {
    	header("Location: ". $redirect);
    } else {
    	header("Location: login.php?p=3");
    }
    exit();
?>