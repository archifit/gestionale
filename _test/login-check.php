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
    // echo $_POST['user'].'</br>'.$_POST['password'].'</br>';
    if ($_POST['rememberme']) {
        // echo 'remember';
    }
}
$_user = $_POST['user'];
$_password = $_POST['password'];

require_once '../common/connect.php';

// controlla prima sul db locale
// Get Docente Details
$query = "SELECT password FROM utente WHERE username = '$_user'";

if (!$result = mysqli_query($con, $query)) {
    exit(mysqli_error($con));
}

$passwordTrovata = '';
if(mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $passwordTrovata = $row['password'];
    }
}
if () {
    
}


require_once 'login-verify.php';

session_destroy();
session_start();

$_SESSION['__username'] = $_user;
if($redirect !== '') {
    header("Location: ". $redirect);
} else {
	header("Location: login.php?p=3");
}
exit();
?>