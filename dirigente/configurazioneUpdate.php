<?php
if(isset($_POST)) {
	require_once '../common/header-session.php';
	require_once '../common/connect.php';

	// prima lo deve caricare cosi' ha anche l'id
	$__config->load();
	$__config->setBonus_adesione_aperto($_POST['bonus_adesione_aperto']);
	$__config->setBonus_rendiconto_aperto($_POST['bonus_rendiconto_aperto']);
	$__config->setOre_previsioni_aperto($_POST['ore_previsioni_aperto']);
	$__config->setOre_fatte_aperto($_POST['ore_fatte_aperto']);
	$__config->setVoti_recupero_settembre_aperto($_POST['voti_recupero_settembre_aperto']);
	$__config->setVoti_recupero_novembre_aperto($_POST['voti_recupero_novembre_aperto']);

	$__config->save();
}
?>
