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
			<div class="form-horizontal">

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="update_nome">Docente</label>
                    <div class="col-sm-5"><input type="text" id="profilo_cognome_e_nome" placeholder="cognome e nome" class="form-control" readonly /></div>

                    <label class="col-sm-2 control-label" for="profilo_tipo_di_contratto">Contratto</label>
                    <div class="col-sm-2"><input type="text" id="profilo_tipo_di_contratto" placeholder="contratto" class="form-control"/></div>

					<button onclick="ricalcola()" class="btn btn-danger"><span class="glyphicon glyphicon-calendar"></span></button>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="profilo_giorni_di_servizio">gg Servizio</label>
                    <div class="col-sm-2"><input type="text" id="profilo_giorni_di_servizio" placeholder="servizio" class="form-control"/></div>

                    <label class="col-sm-2 control-label" for="profilo_ore_di_cattedra">ore Cattedra</label>
                    <div class="col-sm-2"><input type="text" id="profilo_ore_di_cattedra" placeholder="cattedra" class="form-control"/></div>

                    <label class="col-sm-2 control-label" for="profilo_ore_eccedenti">Eccedenti</label>
                    <div class="col-sm-2"><input type="text" id="profilo_ore_eccedenti" placeholder="ore" class="form-control"/></div>
                </div>

                <hr>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="profilo_ore_80_collegi_docenti">Collegio Doc (8)</label>
                    <div class="col-sm-2"><input type="text" id="profilo_ore_80_collegi_docenti" placeholder="cd" class="form-control"/></div>

                    <label class="col-sm-2 control-label" for="profilo_ore_80_udienze_generali">Udienze Gen (8)</label>
                    <div class="col-sm-2"><input type="text" id="profilo_ore_80_udienze_generali" placeholder="udienze" class="form-control"/></div>

                    <label class="col-sm-2 control-label" for="profilo_ore_80_aggiornamento_facoltativo">Aggiorn. (10)</label>
                    <div class="col-sm-2"><input type="text" id="profilo_ore_80_aggiornamento_facoltativo" placeholder="agg" class="form-control"/></div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="profilo_ore_80_dipartimenti_min">Dip min (12)</label>
                    <div class="col-sm-2"><input type="text" id="profilo_ore_80_dipartimenti_min" placeholder="Dip min" class="form-control"/></div>

                    <label class="col-sm-2 control-label" for="profilo_ore_80_dipartimenti_max">Dip Max (24)</label>
                    <div class="col-sm-2"><input type="text" id="profilo_ore_80_dipartimenti_max" placeholder="Dip Max" class="form-control"/></div>

                    <label class="col-sm-2 control-label" for="profilo_ore_80_consigli_di_classe">CDC (30)</label>
                    <div class="col-sm-2"><input type="text" id="profilo_ore_80_consigli_di_classe" placeholder="cdc" class="form-control"/></div>
                </div>

                <hr>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="profilo_ore_40_sostituzioni_di_ufficio">Sostituzioni (18)</label>
                    <div class="col-sm-2"><input type="text" id="profilo_ore_40_sostituzioni_di_ufficio" placeholder="sost" class="form-control"/></div>

                    <label class="col-sm-2 control-label" for="profilo_ore_40_con_studenti">con Stud. (18)</label>
                    <div class="col-sm-2"><input type="text" id="profilo_ore_40_con_studenti" placeholder="stud" class="form-control"/></div>

                    <label class="col-sm-2 control-label" for="profilo_ore_40_aggiornamento">Aggiorn. (10)</label>
                    <div class="col-sm-2"><input type="text" id="profilo_ore_40_aggiornamento" placeholder="Agg" class="form-control"/></div>
                </div>

                <hr>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="profilo_ore_70_funzionali">Funzionali (30)</label>
                    <div class="col-sm-2"><input type="text" id="profilo_ore_70_funzionali" placeholder="funz" class="form-control"/></div>

                    <label class="col-sm-2 control-label" for="profilo_ore_70_con_studenti">con Stud. (40)</label>
                    <div class="col-sm-2"><input type="text" id="profilo_ore_70_con_studenti" placeholder="stud" class="form-control"/></div>
                </div>

                <hr>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="profilo_ore_80_totale">Tot. 80</label>
                    <div class="col-sm-2"><input type="text" id="profilo_ore_80_totale" placeholder="tot 80" class="form-control" readonly /></div>

                    <label class="col-sm-2 control-label" for="profilo_ore_40_totale">Tot. 40</label>
                    <div class="col-sm-2"><input type="text" id="profilo_ore_40_totale" placeholder="tot 40" class="form-control" readonly /></div>

                    <label class="col-sm-2 control-label" for="profilo_ore_70_totale">Tot. 70</label>
                    <div class="col-sm-2"><input type="text" id="profilo_ore_70_totale" placeholder="tot 70" class="form-control" readonly /></div>
                </div>

                <hr>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="profilo_note">Note</label>
                    <div class="col-sm-10"><textarea rows="3" id="profilo_note" placeholder="note" class="form-control" ></textarea></div>
                </div>

			</div>

            </div>
			<div class="panel-footer text-center">
				<button type="button" class="btn btn-default" data-dismiss="modal">Annulla</button>
				<button type="button" class="btn btn-primary" onclick="profiloUpdateDetails()" >Salva</button>
				<input type="hidden" id="hidden_profilo_docente_id">
				<input type="hidden" id="hidden_ore_dovute_id">
				<input type="hidden" id="hidden_ore_previste_id">
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