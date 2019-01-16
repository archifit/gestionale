<?php
	if(isset($_POST)) {
		require_once '../common/header-session.php';
		require_once '../common/connect.php';

		$adesioniDaAggiungereIdList = json_decode($_POST['adesioniDaAggiungereIdList']);
		$adesioniDaTogliereIdList = json_decode($_POST['adesioniDaTogliereIdList']);

		foreach($adesioniDaAggiungereIdList as $daAggiungereId) {
		    $query = "INSERT INTO `bonus_docente`(`approvato`, `docente_id`, `anno_scolastico_id`, `bonus_id`) VALUES (null, $__docente_id, $__anno_scolastico_corrente_id, $daAggiungereId);";
		    debug($query);
		    dbExec($query);
		}
		
		foreach($adesioniDaTogliereIdList as $daTogliereId) {
		    $query = "DELETE FROM `bonus_docente` WHERE id = $daTogliereId;";
		    debug($query);
		    dbExec($query);
		}
	}
?>