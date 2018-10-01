<?php
/**
 * Encrypt text
 *
 * @param string $crypt
 * @param string $key
 * @return string
 */
function cryptECB($crypt, $key) {
	$iv_size = mcrypt_get_iv_size(MCRYPT_3DES, MCRYPT_MODE_ECB);
	$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
	// crypting
	$cryptText = mcrypt_encrypt(MCRYPT_3DES, $key, $crypt, MCRYPT_MODE_ECB, $iv);

	return $cryptText;
}

/**
 * Decrypt text
 * @param string $encrypted
 * @param object $key
 * @return string
 */
function decryptECB($encrypted, $key) {
	$iv_size = mcrypt_get_iv_size(MCRYPT_3DES, MCRYPT_MODE_ECB);
	$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
	// decrypting
	$stringText = mcrypt_decrypt(MCRYPT_3DES, $key, $encrypted, MCRYPT_MODE_ECB, $iv);

	return $stringText;
}

$key = "MYKEYFORCRYPTINGTEXT1234";
$text = "String of testing for crypting and decrypting";

// crypting text
$crypt = cryptECB($text, $key);
$result = base64_encode($crypt);
echo "CRYPT: $result<br>";
require_once __DIR__ . '/__Log.php';
info($result);

// if you want use this on query string or in html page, you can encode this text in base64
// $crypt = base64_encode($crypt);
// first of decrypt you decode
// $crypt = base64_decode($crypt);
// decrypting text
$crypt = base64_decode($result);
$decrypt = decryptECB($crypt, $key);
echo "DECRYPT: $decrypt<br>";

$crypt = base64_decode('amg/R9rZzwrnavYituxInwJwHANBFic+RpnJs6vbnPSTbSQQstPuX1gl4NmBO982');
$decrypt = decryptECB($crypt, $key);
echo "DECRYPT: $decrypt<br>";

?>
