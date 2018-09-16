<?php
	// include Database connection file 
	require_once '../common/header-session.php';
	require_once '../common/connect.php';

	// Design initial table header 
	$data = '
			<div class="table-wrapper">
				<table class="table table-bordered table-striped table-green" id="sostituzione_table">
					<thead>
						<th>Docente</th>
						<th>Giorno</th>
						<th>Ora</th>
						<th>Dovute</th>
						<th>Fatte</th>
						<th>Mancanti</th>
						<th></th>
					</thead>
					<tbody>
                    ';
	require_once '../dirigente/sostituzioneReadSituazioneDocente.php';
	
	foreach ($situazioneDocenteArray as $situazioneDocente) {
	    $perc = (100 / 12) * $situazioneDocente->ore_mancanti;
	    $data .= '
                <tr>
                    <td>'.$situazioneDocente->cognome.' '.$situazioneDocente->nome.'</td>
                    <td>'.$situazioneDocente->giorno_settimana.'</td>
                    <td>'.$situazioneDocente->ora_insegnamento_orario.'</td>
                    <td>'.$situazioneDocente->ore_da_fare.'</td>
                    <td>'.$situazioneDocente->ore_fatte.'</td>';
	    if ($situazioneDocente->ore_da_fare == 0) {
	        $data .= '
	                <td class="text-center"><div class="glyphicon glyphicon-warning-sign text-warning text-center"></div>
                    </td>';
	    } else {
	        $data .= '
	                <td>
                        <div class="progress progress-striped" style=" margin-bottom: 0 !important;" >
                        	<div class="progress-bar progress-bar-info" role="progressbar" style="width: '.$perc.'%;">
                                            '.$situazioneDocente->ore_mancanti.'
                        	</div>
                        </div>
                    </td>';
	    }
	    $data .= '
           			<td>
                        <button onclick="sostituzioneSituazioneDocenteGetDetails(\''.$situazioneDocente->docente_id.'\', \''.$situazioneDocente->cognome.'\', \''.$situazioneDocente->nome.'\', \''.$situazioneDocente->sostituzioneSituazioneDocenteId.'\', \''.$situazioneDocente->giorno_settimana.'\', \''.$situazioneDocente->ora_insegnamento_id.'\', \''.$situazioneDocente->ore_da_fare.'\', \''.$situazioneDocente->ore_mancanti.'\')" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-pencil"></button>
        			</td>
                            
    			</tr>';
	}
	
	$data .= '
					</tbody>
				</table>
			</div>
';

    echo $data;
?>

