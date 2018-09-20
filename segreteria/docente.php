<!DOCTYPE html>
<html>
<head>
	<title>Gestione docenti</title>
	<meta charset="UTF-8">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
</head>

<body >
<?php
	require_once '../common/header-session.php';
	require_once '../common/header-segreteria.php';
	ruoloRichiesto('dirigente','segreteria-docenti');
?>

<!-- Content Section -->
<div class="container-fluid" style="margin-top:60px">
<div class="panel panel-success">
<div class="panel-heading container-fluid">
	<div class="row">
		<div class="col-md-4">
			<h4><span class="glyphicon glyphicon-education"></span>&emsp;Gestione Docenti</h4>
		</div>
	</div>
</div>
<div class="panel-body">
    <div class="row"  style="margin-bottom:10px;">
        <div class="col-md-6">
            <div class="pull-right">
				<label class="checkbox-inline">
					<input type="checkbox" checked data-toggle="toggle"  data-onstyle="primary" id="testCheckBox" >Solo Attivi
				</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="pull-right">
				<button class="btn btn-success" data-toggle="modal" data-target="#add_new_record_modal"><span class="glyphicon glyphicon-plus"></span>&ensp;Nuovo Docente </button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="records_content"></div>
        </div>
    </div>
</div>

<!-- <div class="panel-footer"></div> -->
</div>

<!-- Bootstrap Modals -->
<!-- Modal - Add New Record/docente -->
<div class="modal fade" id="add_new_record_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Nuovo docente</h4>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" id="nome" placeholder="nome" class="form-control"/>
                </div>

                <div class="form-group">
                    <label for="cognome">Cognome</label>
                    <input type="text" id="cognome" placeholder="cognome" class="form-control"/>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" id="email" placeholder="email" class="form-control"/>
                </div>

                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" placeholder="username" class="form-control"/>
                </div>

                <div class="form-group">
                    <label for="matricola">Matricola</label>
                    <input type="text" id="matricola" placeholder="matricola" class="form-control"/>
                </div>

                <div class="form-group">
                    <label for="attivo">Attivo</label>
					<input type="checkbox" checked data-toggle="toggle" data-onstyle="primary" id="attivo" >
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Annulla</button>
                <button type="button" class="btn btn-primary" onclick="docenteAddRecord()">Salva</button>
            </div>
        </div>
    </div>
</div>
<!-- // Modal - Add New Record/docente -->

<!-- Modal - Update docente details -->
<div class="modal fade" id="update_docente_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Aggiorna</h4>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label for="update_nome">Nome</label>
                    <input type="text" id="update_nome" placeholder="nome" class="form-control"/>
                </div>

                <div class="form-group">
                    <label for="update_cognome">Cognome</label>
                    <input type="text" id="update_cognome" placeholder="cognome" class="form-control"/>
                </div>

                <div class="form-group">
                    <label for="update_email">Email</label>
                    <input type="text" id="update_email" placeholder="email" class="form-control"/>
                </div>

                <div class="form-group">
                    <label for="update_username">Username</label>
                    <input type="text" id="update_username" placeholder="username" class="form-control"/>
                </div>

                <div class="form-group">
                    <label for="update_matricola">Matricola</label>
                    <input type="text" id="update_matricola" placeholder="matricola" class="form-control"/>
                </div>

                <div class="form-group">
                    <label for="update_attivo">Attivo</label>
					<input type="checkbox" data-toggle="toggle" data-onstyle="primary" id="update_attivo" >
                </div>

            </div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Annulla</button>
				<button type="button" class="btn btn-primary" onclick="docenteUpdateDetails()" >Salva</button>
				<input type="hidden" id="hidden_docente_id">
				<input type="hidden" id="hidden_era_attivo">
			</div>
        </div>
    </div>
</div>
<!-- // Modal - Update docente details -->

<!-- Modal - Update profilo details -->
<div class="modal fade" id="update_profilo_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalProfiloLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
			<div class="panel panel-danger">
			<div class="panel-heading">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalProfiloLabel">Aggiorna Profilo</h4>
            </div>
            <div class="panel-body">
			<form class="form-horizontal">

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="update_nome">Docente</label>
                    <div class="col-sm-8"><input type="text" id="profilo_cognome_e_nome" placeholder="cognome e nome" class="form-control" readonly /></div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label" for="profilo_classe_di_concorso">Classe di concorso</label>
                    <div class="col-sm-2"><input type="text" id="profilo_classe_di_concorso" placeholder="classe di concorso" class="form-control"/></div>

                    <label class="col-sm-3 control-label" for="profilo_tipo_di_contratto">Tipo di contratto</label>
                    <div class="col-sm-2"><input type="text" id="profilo_tipo_di_contratto" placeholder="tipo di contratto" class="form-control"/></div>
                </div>
                <hr>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="profilo_giorni_di_servizio">gg di Servizio</label>
                    <div class="col-sm-2"><input type="text" id="profilo_giorni_di_servizio" placeholder="giorni di servizio" class="form-control"/></div>

                    <label class="col-sm-2 control-label" for="profilo_ore_di_cattedra">Ore di cattedra</label>
                    <div class="col-sm-2"><input type="text" id="profilo_ore_di_cattedra" placeholder="ore di cattedra" class="form-control"/></div>

                    <label class="col-sm-2 control-label" for="profilo_ore_eccedenti">Eccedenti</label>
                    <div class="col-sm-2"><input type="text" id="profilo_ore_eccedenti" placeholder="ore eccedenti" class="form-control"/></div>
                </div>
                <hr>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="profilo_ore_dovute_70_con_studenti">70 con studenti</label>
                    <div class="col-sm-2"><input type="text" id="profilo_ore_dovute_70_con_studenti" placeholder="ore dovute 70 con studenti" class="form-control"/></div>

                    <label class="col-sm-2 control-label" for="profilo_ore_dovute_70_funzionali">70 funzionali</label>
                    <div class="col-sm-2"><input type="text" id="profilo_ore_dovute_70_funzionali" placeholder="ore dovute 70 funzionali" class="form-control"/></div>

                    <label class="col-sm-2 control-label" for="profilo_ore_dovute_40">40</label>
                    <div class="col-sm-2"><input type="text" id="profilo_ore_dovute_40" placeholder="ore dovute 40" class="form-control"/></div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="profilo_ore_dovute_supplenze">Supplenze</label>
                    <div class="col-sm-2"><input type="text" id="profilo_ore_dovute_supplenze" placeholder="ore dovute supplenze" class="form-control"/></div>

                    <label class="col-sm-2 control-label" for="profilo_ore_dovute_aggiornamento">Aggiornamento</label>
                    <div class="col-sm-2"><input type="text" id="profilo_ore_dovute_aggiornamento" placeholder="ore dovute aggiornamento" class="form-control"/></div>
                </div>
                <hr>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="profilo_ore_dovute_totale_con_studenti">Con Studenti</label>
                    <div class="col-sm-2"><input type="text" id="profilo_ore_dovute_totale_con_studenti" placeholder="ore dovute totale con studenti" class="form-control" readonly /></div>

                    <label class="col-sm-2 control-label" for="profilo_ore_dovute_totale_funzionali">Funzionali</label>
                    <div class="col-sm-2"><input type="text" id="profilo_ore_dovute_totale_funzionali" placeholder="ore dovute totale funzionali" class="form-control" readonly /></div>

                    <label class="col-sm-2 control-label" for="profilo_ore_dovute_totale">Totale</label>
                    <div class="col-sm-2"><input type="text" id="profilo_ore_dovute_totale" placeholder="ore dovute totale" class="form-control" readonly /></div>
                </div>

			</form>

            </div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Annulla</button>
				<button type="button" class="btn btn-primary" onclick="profiloUpdateDetails()" >Salva</button>
				<input type="hidden" id="hidden_profilo_id">
			</div>
			</div>
			</div>
        </div>
    </div>
</div>
<!-- // Modal - Update profilo details -->
</div>

<!-- Bootstrap, jquery etc (css + js) -->
<?php
	require_once '../common/style.php';
?>
<link rel="stylesheet" href="<?php echo $__application_base_path; ?>/common/bootstrap-toggle-master/css/bootstrap-toggle.min.css">
<script type="text/javascript" src="<?php echo $__application_base_path; ?>/common/bootstrap-toggle-master/js/bootstrap-toggle.min.js"></script>

<link rel="stylesheet" href="<?php echo $__application_base_path; ?>/css/table-green.css">
<link rel="stylesheet" href="<?php echo $__application_base_path; ?>/css/header-style.css">

<!-- Custom JS file -->
<script type="text/javascript" src="js/script.js"></script>
</body>
</html>