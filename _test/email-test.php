<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Send Email Test</title>
</head>
<body>

<?php

$to = "paolo.scapin@martinomartini.eu";
$subject = "local testing e-mail";
$sender = "postmaster@martinomartini.eu";

$headers = "From: $sender\n";
$headers .= "MIME-Version: 1.0\n";
$headers .= "Content-Type: text/html; charset=\"utf-8\"\n";
$headers .= "X-Mailer: PHP " . phpversion();

// Corpi del messaggio nei due formati testo e HTML
$text_msg = "messaggio in formato testo";
$html_msg = "
<html><body>
Gentile Paolo Scapin,
<p>il Dirigente Scolastico le ha conferito l&rsquo;incarico di accompagnatore degli studenti durante la visita a <b>Pavia</b> del giorno <b>12 marzo 1978.</b></p>
<p>La preghiamo di confermare al più presto la sua disponibilità confermando sul sito di
<a href='http://localhost/joomla/gestionale/docente/viaggio.php'>accettare l'incarico</a></p>
<p>gestionale martini</p>
</body></html>
";

$msg = $html_msg;

// Imposta il Return-Path (funziona solo su hosting Windows)
ini_set("sendmail_from", $sender);

// Invia il messaggio, il quinto parametro "-f$sender" imposta il Return-Path su hosting Linux
if (mail($to, $subject, $msg, $headers, "-f$sender")) {
    echo "Mail sent successfully !<br><br>This is the source code used for sending the e-mail:<br><br>";
} else {
    echo "<br><br>Mail delivery failed!";
}

?>

</body>
</html>