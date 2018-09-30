<!DOCTYPE html>
<html>
<head>
<?php
require_once '../_test/checkSession.php';
?>
	<title>Landing Page 2</title>
</head>

<body >
	<h2>landing</h2>
<?php
echo $__username.'</br>';
echo $session->get('__username').'</br>';
echo $session->get('__application_base_path').'</br>';
echo $session->get('__application_base_path').'</br>';
echo ( '2! __username=' . $__username ).'</br>';
echo ( '__anno_scolastico_corrente_id=' . $__anno_scolastico_corrente_id ).'</br>';
echo ( '__anno_scolastico_corrente_anno=' . $__anno_scolastico_corrente_anno ).'</br>';
echo ( '__anno_scolastico_scorso_id=' . $__anno_scolastico_scorso_id ).'</br>';
echo ( '__utente_id=' . $__utente_id ).'</br>';
echo ( '__utente_nome=' . $__utente_nome ).'</br>';
echo ( '__utente_cognome=' . $__utente_cognome ).'</br>';
echo ( '__utente_ruolo=' . $__utente_ruolo ).'</br>';
echo ( '__docente_id=' . $__docente_id ).'</br>';
echo ( '__docente_nome=' . $__docente_nome ).'</br>';
echo ( '__docente_cognome=' . $__docente_cognome ).'</br>';
echo ( '__docente_email=' . $__docente_email ).'</br>';

?>
</body>
</html>