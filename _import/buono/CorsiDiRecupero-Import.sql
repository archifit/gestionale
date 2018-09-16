USE Sql1102145_2;
	
	
-- MATEMATICA_1 - prende docente.id dal cognome Ianes
SELECT `id` FROM docente
WHERE docente.cognome='Ianes' LIMIT 1
INTO @docente_id;

-- prende profilo_docente.id dal id ricavato da cognome Ianes
SELECT `id` FROM profilo_docente
WHERE profilo_docente.anno_scolastico_id = '1'
	AND profilo_docente.docente_id = '39' LIMIT 1
INTO @profilo_docente_id;

-- prende materia.id dal codice Mate
SELECT `id` FROM materia
WHERE materia.codice='Mate' LIMIT 1
INTO @materia_id;

INSERT INTO corso_di_recupero (
	codice,
	aula,
	docente_id,
	profilo_docente_id,
	anno_scolastico_id,
	materia_id
	)
VALUES (
	'MATEMATICA_1',
	'FIS1',
	@docente_id,
	@profilo_docente_id,
	'1',
	@materia_id
);
SET @last_id_corso_di_recupero = LAST_INSERT_ID();

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-08-04',
	'9:45:00',
	2,
	'9:45-11:25',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-08-05',
	'9:45:00',
	2,
	'9:45-11:25',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-08-06',
	'9:45:00',
	2,
	'9:45-11:25',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-08-07',
	'9:45:00',
	2,
	'9:45-11:25',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-08-10',
	'9:45:00',
	2,
	'9:45-11:25',
	@last_id_corso_di_recupero
);

UPDATE corso_di_recupero
SET
	numero_ore=10
WHERE
	corso_di_recupero.id=@last_id_corso_di_recupero
;

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Frasnelli',
	'Silvia',
	'1LOS',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Lleshi',
	'Florida',
	'1LOS',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Tonfolini',
	'Sara',
	'1LOS',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Bazzanella',
	'Giulio',
	'1LISA',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Fellin',
	'Sebastiano',
	'1LISA',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Guarnieri',
	'Alessandro',
	'1LISA',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Panizza',
	'Stefano',
	'1LISA',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Torresani',
	'Matteo',
	'1LISA',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Gianasi',
	'Gabriel',
	'1LISB',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Giovannini',
	'Elisa',
	'1LISB',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Banzi',
	'Stefano',
	'1LISC',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Bonetti',
	'Angelica',
	'1LISC',
	@last_id_corso_di_recupero
);

INSERT INTO studente_partecipa_lezione_corso_di_recupero (
	lezione_corso_di_recupero_id,
	studente_per_corso_di_recupero_id
	)
SELECT lezione_corso_di_recupero.id, studente_per_corso_di_recupero.id 
FROM lezione_corso_di_recupero, studente_per_corso_di_recupero
WHERE
	lezione_corso_di_recupero.corso_di_recupero_id = @last_id_corso_di_recupero
AND
	studente_per_corso_di_recupero.corso_di_recupero_id = @last_id_corso_di_recupero
;


-- INGLESE_1 - prende docente.id dal cognome Scapin
SELECT `id` FROM docente
WHERE docente.cognome='Scapin' LIMIT 1
INTO @docente_id;

-- prende profilo_docente.id dal id ricavato da cognome Scapin
SELECT `id` FROM profilo_docente
WHERE profilo_docente.anno_scolastico_id = '1'
	AND profilo_docente.docente_id = '72' LIMIT 1
INTO @profilo_docente_id;

-- prende materia.id dal codice Ing-T
SELECT `id` FROM materia
WHERE materia.codice='Ing-T' LIMIT 1
INTO @materia_id;

INSERT INTO corso_di_recupero (
	codice,
	aula,
	docente_id,
	profilo_docente_id,
	anno_scolastico_id,
	materia_id
	)
VALUES (
	'INGLESE_1',
	'ING4',
	@docente_id,
	@profilo_docente_id,
	'1',
	@materia_id
);
SET @last_id_corso_di_recupero = LAST_INSERT_ID();

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-04',
	'11:30:00',
	2,
	'11:30-13:10',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-05',
	'11:30:00',
	2,
	'11:30-13:10',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-06',
	'11:30:00',
	2,
	'11:30-13:10',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-07',
	'11:30:00',
	2,
	'11:30-13:10',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-10',
	'13:30:00',
	2,
	'13:30-15:10',
	@last_id_corso_di_recupero
);

UPDATE corso_di_recupero
SET
	numero_ore=10
WHERE
	corso_di_recupero.id=@last_id_corso_di_recupero
;

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Bazzanella',
	'Giulio',
	'1LISA',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Fellin',
	'Sebastiano',
	'1LISA',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Guarnieri',
	'Alessandro',
	'1LISA',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Giordano',
	'Angelica',
	'1LISB',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Giovannini',
	'Elisa',
	'1LISB',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Brugnara',
	'Natasha',
	'1LISC',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Villotti',
	'Luca',
	'1LISC',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Battaini',
	'Clara',
	'1LES',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Borghesi',
	'Pablo',
	'1LES',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Grazioli',
	'Arianna',
	'1LES',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Tommasini',
	'Sharon',
	'1LES',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Tonon',
	'Andrea',
	'1LES',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Troka',
	'Ilaria',
	'1LES',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Mantini',
	'Giovanni',
	'TR LES',
	@last_id_corso_di_recupero
);

INSERT INTO studente_partecipa_lezione_corso_di_recupero (
	lezione_corso_di_recupero_id,
	studente_per_corso_di_recupero_id
	)
SELECT lezione_corso_di_recupero.id, studente_per_corso_di_recupero.id 
FROM lezione_corso_di_recupero, studente_per_corso_di_recupero
WHERE
	lezione_corso_di_recupero.corso_di_recupero_id = @last_id_corso_di_recupero
AND
	studente_per_corso_di_recupero.corso_di_recupero_id = @last_id_corso_di_recupero
;


-- TEDESCO_1 - prende docente.id dal cognome Maranzi
SELECT `id` FROM docente
WHERE docente.cognome='Maranzi' LIMIT 1
INTO @docente_id;

-- prende profilo_docente.id dal id ricavato da cognome Maranzi
SELECT `id` FROM profilo_docente
WHERE profilo_docente.anno_scolastico_id = '1'
	AND profilo_docente.docente_id = '48' LIMIT 1
INTO @profilo_docente_id;

-- prende materia.id dal codice Ted-T
SELECT `id` FROM materia
WHERE materia.codice='Ted-T' LIMIT 1
INTO @materia_id;

INSERT INTO corso_di_recupero (
	codice,
	aula,
	docente_id,
	profilo_docente_id,
	anno_scolastico_id,
	materia_id
	)
VALUES (
	'TEDESCO_1',
	'TED1',
	@docente_id,
	@profilo_docente_id,
	'1',
	@materia_id
);
SET @last_id_corso_di_recupero = LAST_INSERT_ID();

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-04',
	'14:00:00',
	2,
	'14:00-15:40',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-05',
	'14:00:00',
	2,
	'14:00-15:40',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-06',
	'14:00:00',
	2,
	'14:00-15:40',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-07',
	'14:00:00',
	2,
	'14:00-15:40',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-10',
	'14:00:00',
	2,
	'14:00-15:40',
	@last_id_corso_di_recupero
);

UPDATE corso_di_recupero
SET
	numero_ore=10
WHERE
	corso_di_recupero.id=@last_id_corso_di_recupero
;

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Endrizzi',
	'Anna',
	'1LOS',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Fellin',
	'Sebastiano',
	'1LISA',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Battaini',
	'Clara',
	'1LES',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Dello-russo',
	'Irene',
	'1LES',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Tonon',
	'Andrea',
	'1LES',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Cappelletti',
	'Simone',
	'1ITE',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Faggiani',
	'Giovanni',
	'1ITE',
	@last_id_corso_di_recupero
);

INSERT INTO studente_partecipa_lezione_corso_di_recupero (
	lezione_corso_di_recupero_id,
	studente_per_corso_di_recupero_id
	)
SELECT lezione_corso_di_recupero.id, studente_per_corso_di_recupero.id 
FROM lezione_corso_di_recupero, studente_per_corso_di_recupero
WHERE
	lezione_corso_di_recupero.corso_di_recupero_id = @last_id_corso_di_recupero
AND
	studente_per_corso_di_recupero.corso_di_recupero_id = @last_id_corso_di_recupero
;


-- ITALIANO_1 - prende docente.id dal cognome Tommasini
SELECT `id` FROM docente
WHERE docente.cognome='Tommasini' LIMIT 1
INTO @docente_id;

-- prende profilo_docente.id dal id ricavato da cognome Tommasini
SELECT `id` FROM profilo_docente
WHERE profilo_docente.anno_scolastico_id = '1'
	AND profilo_docente.docente_id = '87' LIMIT 1
INTO @profilo_docente_id;

-- prende materia.id dal codice Ita
SELECT `id` FROM materia
WHERE materia.codice='Ita' LIMIT 1
INTO @materia_id;

INSERT INTO corso_di_recupero (
	codice,
	aula,
	docente_id,
	profilo_docente_id,
	anno_scolastico_id,
	materia_id
	)
VALUES (
	'ITALIANO_1',
	'ITA1',
	@docente_id,
	@profilo_docente_id,
	'1',
	@materia_id
);
SET @last_id_corso_di_recupero = LAST_INSERT_ID();

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-04',
	'14:00:00',
	2,
	'14:00-15:40',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-05',
	'14:00:00',
	2,
	'14:00-15:40',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-06',
	'14:00:00',
	2,
	'14:00-15:40',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-07',
	'14:00:00',
	2,
	'14:00-15:40',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-10',
	'14:00:00',
	2,
	'14:00-15:40',
	@last_id_corso_di_recupero
);

UPDATE corso_di_recupero
SET
	numero_ore=10
WHERE
	corso_di_recupero.id=@last_id_corso_di_recupero
;

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Borghesi',
	'Pablo',
	'1LES',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Grazioli',
	'Arianna',
	'1LES',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Moser',
	'Fernandez Jose\' Maria',
	'1LES',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Troka',
	'Ilaria',
	'1LES',
	@last_id_corso_di_recupero
);

INSERT INTO studente_partecipa_lezione_corso_di_recupero (
	lezione_corso_di_recupero_id,
	studente_per_corso_di_recupero_id
	)
SELECT lezione_corso_di_recupero.id, studente_per_corso_di_recupero.id 
FROM lezione_corso_di_recupero, studente_per_corso_di_recupero
WHERE
	lezione_corso_di_recupero.corso_di_recupero_id = @last_id_corso_di_recupero
AND
	studente_per_corso_di_recupero.corso_di_recupero_id = @last_id_corso_di_recupero
;


-- FISICA_1 - prende docente.id dal cognome Ianes
SELECT `id` FROM docente
WHERE docente.cognome='Ianes' LIMIT 1
INTO @docente_id;

-- prende profilo_docente.id dal id ricavato da cognome Ianes
SELECT `id` FROM profilo_docente
WHERE profilo_docente.anno_scolastico_id = '1'
	AND profilo_docente.docente_id = '39' LIMIT 1
INTO @profilo_docente_id;

-- prende materia.id dal codice Fis-T
SELECT `id` FROM materia
WHERE materia.codice='Fis-T' LIMIT 1
INTO @materia_id;

INSERT INTO corso_di_recupero (
	codice,
	aula,
	docente_id,
	profilo_docente_id,
	anno_scolastico_id,
	materia_id
	)
VALUES (
	'FISICA_1',
	'FIS1',
	@docente_id,
	@profilo_docente_id,
	'1',
	@materia_id
);
SET @last_id_corso_di_recupero = LAST_INSERT_ID();

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-04',
	'8:00:00',
	2,
	'8:00-9:40',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-05',
	'8:00:00',
	2,
	'8:00-9:40',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-06',
	'8:00:00',
	2,
	'8:00-9:40',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-07',
	'8:00:00',
	2,
	'8:00-9:40',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-10',
	'8:00:00',
	2,
	'8:00-9:40',
	@last_id_corso_di_recupero
);

UPDATE corso_di_recupero
SET
	numero_ore=10
WHERE
	corso_di_recupero.id=@last_id_corso_di_recupero
;

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Frasnelli',
	'Silvia',
	'1LOS',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Tonfolini',
	'Sara',
	'1LOS',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Gianasi',
	'Gabriel',
	'1LISB',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Giordano',
	'Angelica',
	'1LISB',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Giovannini',
	'Elisa',
	'1LISB',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Banzi',
	'Stefano',
	'1LISC',
	@last_id_corso_di_recupero
);

INSERT INTO studente_partecipa_lezione_corso_di_recupero (
	lezione_corso_di_recupero_id,
	studente_per_corso_di_recupero_id
	)
SELECT lezione_corso_di_recupero.id, studente_per_corso_di_recupero.id 
FROM lezione_corso_di_recupero, studente_per_corso_di_recupero
WHERE
	lezione_corso_di_recupero.corso_di_recupero_id = @last_id_corso_di_recupero
AND
	studente_per_corso_di_recupero.corso_di_recupero_id = @last_id_corso_di_recupero
;


-- MATEMATICA_2 - corso PON - prende docente.id dal cognome Pagliacci
SELECT `id` FROM docente
WHERE docente.cognome='Pagliacci' LIMIT 1
INTO @docente_id;

-- prende profilo_docente.id dal id ricavato da cognome Pagliacci
SELECT `id` FROM profilo_docente
WHERE profilo_docente.anno_scolastico_id = '1'
	AND profilo_docente.docente_id = '59' LIMIT 1
INTO @profilo_docente_id;

-- prende materia.id dal codice Mate
SELECT `id` FROM materia
WHERE materia.codice='Mate' LIMIT 1
INTO @materia_id;

INSERT INTO corso_di_recupero (
	codice,
	aula,
	docente_id,
	profilo_docente_id,
	anno_scolastico_id,
	materia_id
	)
VALUES (
	'MATEMATICA_2 - corso PON',
	'MAT3',
	@docente_id,
	@profilo_docente_id,
	'1',
	@materia_id
);
SET @last_id_corso_di_recupero = LAST_INSERT_ID();

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-04',
	'8:15:00',
	2,
	'8:15-11:15',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-05',
	'8:15:00',
	2,
	'8:15-11:15',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-06',
	'8:15:00',
	2,
	'8:15-11:15',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-07',
	'8:15:00',
	2,
	'8:15-11:15',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-10',
	'8:15:00',
	2,
	'8:15-11:15',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-11',
	'8:15:00',
	2,
	'8:15-11:15',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-12',
	'13.20:00',
	2,
	'13.20-16.20',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-14',
	'13.20:00',
	2,
	'13.20-16.20',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-17',
	'14:00:00',
	2,
	'14:00-17:00',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-18',
	'14:00:00',
	2,
	'14:00-17:00',
	@last_id_corso_di_recupero
);

UPDATE corso_di_recupero
SET
	numero_ore=20
WHERE
	corso_di_recupero.id=@last_id_corso_di_recupero
;

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Borghesi',
	'Pablo',
	'1LES',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Dello-russo',
	'Irene',
	'1LES',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Ghezzi',
	'Giorgia',
	'1LES',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Grazioli',
	'Arianna',
	'1LES',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Tonon',
	'Andrea',
	'1LES',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Troka',
	'Ilaria',
	'1LES',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Mantini',
	'Giovanni',
	'TR LES',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Battan',
	'Vivien',
	'1ITE',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Noldin',
	'Amos',
	'1ITE',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Piragic',
	'David',
	'1ITE',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Marra',
	'Giada',
	'TR ITE',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Andreolli',
	'Nicola',
	'1ITTA',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Rrushi',
	'Nertila',
	'1ITTA',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Cano',
	'Ruiz Joel',
	'1ITTB',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Maiorca',
	'Matteo',
	'1ITTB',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Pederzolli',
	'Giacomo',
	'1ITTB',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Segheir',
	'Salahedine',
	'1ITTB',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Nardon',
	'Davide',
	'TR ITT',
	@last_id_corso_di_recupero
);

INSERT INTO studente_partecipa_lezione_corso_di_recupero (
	lezione_corso_di_recupero_id,
	studente_per_corso_di_recupero_id
	)
SELECT lezione_corso_di_recupero.id, studente_per_corso_di_recupero.id 
FROM lezione_corso_di_recupero, studente_per_corso_di_recupero
WHERE
	lezione_corso_di_recupero.corso_di_recupero_id = @last_id_corso_di_recupero
AND
	studente_per_corso_di_recupero.corso_di_recupero_id = @last_id_corso_di_recupero
;


-- INGLESE_2 - prende docente.id dal cognome Osti
SELECT `id` FROM docente
WHERE docente.cognome='Osti' LIMIT 1
INTO @docente_id;

-- prende profilo_docente.id dal id ricavato da cognome Osti
SELECT `id` FROM profilo_docente
WHERE profilo_docente.anno_scolastico_id = '1'
	AND profilo_docente.docente_id = '58' LIMIT 1
INTO @profilo_docente_id;

-- prende materia.id dal codice Ing-T
SELECT `id` FROM materia
WHERE materia.codice='Ing-T' LIMIT 1
INTO @materia_id;

INSERT INTO corso_di_recupero (
	codice,
	aula,
	docente_id,
	profilo_docente_id,
	anno_scolastico_id,
	materia_id
	)
VALUES (
	'INGLESE_2',
	'ING3',
	@docente_id,
	@profilo_docente_id,
	'1',
	@materia_id
);
SET @last_id_corso_di_recupero = LAST_INSERT_ID();

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-04',
	'14:00:00',
	2,
	'14:00-15:40',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-05',
	'14:00:00',
	2,
	'14:00-15:40',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-06',
	'14:00:00',
	2,
	'14:00-15:40',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-07',
	'14:00:00',
	2,
	'14:00-15:40',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-10',
	'14:00:00',
	2,
	'14:00-15:40',
	@last_id_corso_di_recupero
);

UPDATE corso_di_recupero
SET
	numero_ore=10
WHERE
	corso_di_recupero.id=@last_id_corso_di_recupero
;

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Dalfovo',
	'Nicol',
	'1ITE',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Andreolli',
	'Nicola',
	'1ITTA',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Gregori',
	'Alessandro',
	'1ITTA',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Rizzardi',
	'Davide',
	'1ITTA',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Cano',
	'Ruiz Joel',
	'1ITTB',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Maiorca',
	'Matteo',
	'1ITTB',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Pederzolli',
	'Giacomo',
	'1ITTB',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Tomoiaga',
	'Denis Robert',
	'1ITTB',
	@last_id_corso_di_recupero
);

INSERT INTO studente_partecipa_lezione_corso_di_recupero (
	lezione_corso_di_recupero_id,
	studente_per_corso_di_recupero_id
	)
SELECT lezione_corso_di_recupero.id, studente_per_corso_di_recupero.id 
FROM lezione_corso_di_recupero, studente_per_corso_di_recupero
WHERE
	lezione_corso_di_recupero.corso_di_recupero_id = @last_id_corso_di_recupero
AND
	studente_per_corso_di_recupero.corso_di_recupero_id = @last_id_corso_di_recupero
;


-- ECONOMIA AZIENDALE_1 - prende docente.id dal cognome Nicolussi
SELECT `id` FROM docente
WHERE docente.cognome='Nicolussi' LIMIT 1
INTO @docente_id;

-- prende profilo_docente.id dal id ricavato da cognome Nicolussi
SELECT `id` FROM profilo_docente
WHERE profilo_docente.anno_scolastico_id = '1'
	AND profilo_docente.docente_id = '54' LIMIT 1
INTO @profilo_docente_id;

-- prende materia.id dal codice Ec.Az
SELECT `id` FROM materia
WHERE materia.codice='Ec.Az' LIMIT 1
INTO @materia_id;

INSERT INTO corso_di_recupero (
	codice,
	aula,
	docente_id,
	profilo_docente_id,
	anno_scolastico_id,
	materia_id
	)
VALUES (
	'ECONOMIA AZIENDALE_1',
	'LAB EC. AZ',
	@docente_id,
	@profilo_docente_id,
	'1',
	@materia_id
);
SET @last_id_corso_di_recupero = LAST_INSERT_ID();

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-04',
	'9:45:00',
	2,
	'9:45-11:25',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-05',
	'9:45:00',
	2,
	'9:45-11:25',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-06',
	'9:45:00',
	2,
	'9:45-11:25',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-07',
	'9:45:00',
	2,
	'9:45-11:25',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-10',
	'9:45:00',
	2,
	'9:45-11:25',
	@last_id_corso_di_recupero
);

UPDATE corso_di_recupero
SET
	numero_ore=10
WHERE
	corso_di_recupero.id=@last_id_corso_di_recupero
;

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Bompasso',
	'Salvatore Francesco',
	'1ITE',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Cappelletti',
	'Simone',
	'1ITE',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Dalfovo',
	'Nicol',
	'1ITE',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Stenico',
	'Sara',
	'1ITE',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Berto\'',
	'Giacomo***',
	'TR ITE',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Filippi',
	'Manuel***',
	'TR AFM',
	@last_id_corso_di_recupero
);

INSERT INTO studente_partecipa_lezione_corso_di_recupero (
	lezione_corso_di_recupero_id,
	studente_per_corso_di_recupero_id
	)
SELECT lezione_corso_di_recupero.id, studente_per_corso_di_recupero.id 
FROM lezione_corso_di_recupero, studente_per_corso_di_recupero
WHERE
	lezione_corso_di_recupero.corso_di_recupero_id = @last_id_corso_di_recupero
AND
	studente_per_corso_di_recupero.corso_di_recupero_id = @last_id_corso_di_recupero
;


-- STORIA_1 - prende docente.id dal cognome Corradini
SELECT `id` FROM docente
WHERE docente.cognome='Corradini' LIMIT 1
INTO @docente_id;

-- prende profilo_docente.id dal id ricavato da cognome Corradini
SELECT `id` FROM profilo_docente
WHERE profilo_docente.anno_scolastico_id = '1'
	AND profilo_docente.docente_id = '11' LIMIT 1
INTO @profilo_docente_id;

-- prende materia.id dal codice Sto
SELECT `id` FROM materia
WHERE materia.codice='Sto' LIMIT 1
INTO @materia_id;

INSERT INTO corso_di_recupero (
	codice,
	aula,
	docente_id,
	profilo_docente_id,
	anno_scolastico_id,
	materia_id
	)
VALUES (
	'STORIA_1',
	'ITA2',
	@docente_id,
	@profilo_docente_id,
	'1',
	@materia_id
);
SET @last_id_corso_di_recupero = LAST_INSERT_ID();

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-04',
	'11:30:00',
	2,
	'11:30-13:10',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-05',
	'11:30:00',
	2,
	'11:30-13:10',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-06',
	'11:30:00',
	2,
	'11:30-13:10',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-07',
	'11:30:00',
	2,
	'11:30-13:10',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-10',
	'13:30:00',
	2,
	'13:30-15:10',
	@last_id_corso_di_recupero
);

UPDATE corso_di_recupero
SET
	numero_ore=10
WHERE
	corso_di_recupero.id=@last_id_corso_di_recupero
;

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Guarnieri',
	'Alessandro',
	'1LISA',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Panizza',
	'Stefano',
	'1LISA',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Cappelletti',
	'Simone',
	'1ITE',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Noldin',
	'Amos',
	'1ITE',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Ndiaye',
	'Ibrahima Souleymane',
	'1ITTA',
	@last_id_corso_di_recupero
);

INSERT INTO studente_partecipa_lezione_corso_di_recupero (
	lezione_corso_di_recupero_id,
	studente_per_corso_di_recupero_id
	)
SELECT lezione_corso_di_recupero.id, studente_per_corso_di_recupero.id 
FROM lezione_corso_di_recupero, studente_per_corso_di_recupero
WHERE
	lezione_corso_di_recupero.corso_di_recupero_id = @last_id_corso_di_recupero
AND
	studente_per_corso_di_recupero.corso_di_recupero_id = @last_id_corso_di_recupero
;


-- FISICA_2 - prende docente.id dal cognome Ianes
SELECT `id` FROM docente
WHERE docente.cognome='Ianes' LIMIT 1
INTO @docente_id;

-- prende profilo_docente.id dal id ricavato da cognome Ianes
SELECT `id` FROM profilo_docente
WHERE profilo_docente.anno_scolastico_id = '1'
	AND profilo_docente.docente_id = '39' LIMIT 1
INTO @profilo_docente_id;

-- prende materia.id dal codice Fis-T
SELECT `id` FROM materia
WHERE materia.codice='Fis-T' LIMIT 1
INTO @materia_id;

INSERT INTO corso_di_recupero (
	codice,
	aula,
	docente_id,
	profilo_docente_id,
	anno_scolastico_id,
	materia_id
	)
VALUES (
	'FISICA_2',
	'FIS1',
	@docente_id,
	@profilo_docente_id,
	'1',
	@materia_id
);
SET @last_id_corso_di_recupero = LAST_INSERT_ID();

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-04',
	'11:30:00',
	2,
	'11:30-13:10',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-05',
	'11:30:00',
	2,
	'11:30-13:10',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-06',
	'11:30:00',
	2,
	'11:30-13:10',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-07',
	'11:30:00',
	2,
	'11:30-13:10',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-10',
	'11:30:00',
	2,
	'11:30-13:10',
	@last_id_corso_di_recupero
);

UPDATE corso_di_recupero
SET
	numero_ore=10
WHERE
	corso_di_recupero.id=@last_id_corso_di_recupero
;

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Gregori',
	'Alessandro',
	'1ITTA',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Maiorca',
	'Matteo',
	'1ITTB',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Segheir',
	'Salahedine',
	'1ITTB',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Nardon',
	'Davide',
	'TR ITT',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Piragic',
	'David',
	'1ITE',
	@last_id_corso_di_recupero
);

INSERT INTO studente_partecipa_lezione_corso_di_recupero (
	lezione_corso_di_recupero_id,
	studente_per_corso_di_recupero_id
	)
SELECT lezione_corso_di_recupero.id, studente_per_corso_di_recupero.id 
FROM lezione_corso_di_recupero, studente_per_corso_di_recupero
WHERE
	lezione_corso_di_recupero.corso_di_recupero_id = @last_id_corso_di_recupero
AND
	studente_per_corso_di_recupero.corso_di_recupero_id = @last_id_corso_di_recupero
;


-- MATEMATICA_3 - prende docente.id dal cognome Moratelli
SELECT `id` FROM docente
WHERE docente.cognome='Moratelli' LIMIT 1
INTO @docente_id;

-- prende profilo_docente.id dal id ricavato da cognome Moratelli
SELECT `id` FROM profilo_docente
WHERE profilo_docente.anno_scolastico_id = '1'
	AND profilo_docente.docente_id = '51' LIMIT 1
INTO @profilo_docente_id;

-- prende materia.id dal codice Mate
SELECT `id` FROM materia
WHERE materia.codice='Mate' LIMIT 1
INTO @materia_id;

INSERT INTO corso_di_recupero (
	codice,
	aula,
	docente_id,
	profilo_docente_id,
	anno_scolastico_id,
	materia_id
	)
VALUES (
	'MATEMATICA_3',
	'MAT6',
	@docente_id,
	@profilo_docente_id,
	'1',
	@materia_id
);
SET @last_id_corso_di_recupero = LAST_INSERT_ID();

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-04',
	'11:30:00',
	2,
	'11:30-13:10',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-05',
	'11:30:00',
	2,
	'11:30-13:10',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-06',
	'11:30:00',
	2,
	'11:30-13:10',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-07',
	'11:30:00',
	2,
	'11:30-13:10',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-10',
	'11:30:00',
	2,
	'11:30-13:10',
	@last_id_corso_di_recupero
);

UPDATE corso_di_recupero
SET
	numero_ore=10
WHERE
	corso_di_recupero.id=@last_id_corso_di_recupero
;

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Rampanelli',
	'Angela***',
	'TR LOS4',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Borzaga',
	'Leonardo',
	'1LOS4',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Castellan',
	'Bruno',
	'1LOS4',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Salvadori',
	'Sara',
	'2LOS',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Bottamedi',
	'Federica',
	'2LISA',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Girardi',
	'Arianna',
	'2LISA',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Tait',
	'Mario',
	'2LISA',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Telch',
	'Federico',
	'2LISA',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Floriani',
	'Sofia',
	'2LISB',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Gasperat',
	'Paolo',
	'2LISB',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Gorni',
	'Sabrina',
	'2LISB',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Iachemet',
	'Gabriele',
	'2LISB',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Marinelli',
	'Alessio',
	'2LISB',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Valentinotti',
	'Alessio',
	'2LISB',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Zadra',
	'Nicole',
	'TR LIS',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Rossi',
	'Martina***',
	'LIS',
	@last_id_corso_di_recupero
);

INSERT INTO studente_partecipa_lezione_corso_di_recupero (
	lezione_corso_di_recupero_id,
	studente_per_corso_di_recupero_id
	)
SELECT lezione_corso_di_recupero.id, studente_per_corso_di_recupero.id 
FROM lezione_corso_di_recupero, studente_per_corso_di_recupero
WHERE
	lezione_corso_di_recupero.corso_di_recupero_id = @last_id_corso_di_recupero
AND
	studente_per_corso_di_recupero.corso_di_recupero_id = @last_id_corso_di_recupero
;


-- TEDESCO_2 - prende docente.id dal cognome Onorino
SELECT `id` FROM docente
WHERE docente.cognome='Onorino' LIMIT 1
INTO @docente_id;

-- prende profilo_docente.id dal id ricavato da cognome Onorino
SELECT `id` FROM profilo_docente
WHERE profilo_docente.anno_scolastico_id = '1'
	AND profilo_docente.docente_id = '57' LIMIT 1
INTO @profilo_docente_id;

-- prende materia.id dal codice Ted-T
SELECT `id` FROM materia
WHERE materia.codice='Ted-T' LIMIT 1
INTO @materia_id;

INSERT INTO corso_di_recupero (
	codice,
	aula,
	docente_id,
	profilo_docente_id,
	anno_scolastico_id,
	materia_id
	)
VALUES (
	'TEDESCO_2',
	'TED2',
	@docente_id,
	@profilo_docente_id,
	'1',
	@materia_id
);
SET @last_id_corso_di_recupero = LAST_INSERT_ID();

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-04',
	'8:00:00',
	2,
	'8:00-9:40',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-05',
	'8:00:00',
	2,
	'8:00-9:40',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-06',
	'8:00:00',
	2,
	'8:00-9:40',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-07',
	'8:00:00',
	2,
	'8:00-9:40',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-10',
	'8:00:00',
	2,
	'8:00-9:40',
	@last_id_corso_di_recupero
);

UPDATE corso_di_recupero
SET
	numero_ore=10
WHERE
	corso_di_recupero.id=@last_id_corso_di_recupero
;

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Hila',
	'Jessica',
	'2LES',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Santoro',
	'Tania',
	'2LES',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Berti',
	'Alessandro',
	'2ITE',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Guarracino',
	'Emily',
	'2ITE',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Perlot',
	'Sara',
	'TR-LES',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Calovi',
	'Mattia',
	'2ITT',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'El-harda',
	'Oissim',
	'2ITT',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Lombardi',
	'Diego',
	'2ITT',
	@last_id_corso_di_recupero
);

INSERT INTO studente_partecipa_lezione_corso_di_recupero (
	lezione_corso_di_recupero_id,
	studente_per_corso_di_recupero_id
	)
SELECT lezione_corso_di_recupero.id, studente_per_corso_di_recupero.id 
FROM lezione_corso_di_recupero, studente_per_corso_di_recupero
WHERE
	lezione_corso_di_recupero.corso_di_recupero_id = @last_id_corso_di_recupero
AND
	studente_per_corso_di_recupero.corso_di_recupero_id = @last_id_corso_di_recupero
;


-- ITALIANO_2 - prende docente.id dal cognome Del Dot
SELECT `id` FROM docente
WHERE docente.cognome='Del Dot' LIMIT 1
INTO @docente_id;

-- prende profilo_docente.id dal id ricavato da cognome Del Dot
SELECT `id` FROM profilo_docente
WHERE profilo_docente.anno_scolastico_id = '1'
	AND profilo_docente.docente_id = '22' LIMIT 1
INTO @profilo_docente_id;

-- prende materia.id dal codice Ita
SELECT `id` FROM materia
WHERE materia.codice='Ita' LIMIT 1
INTO @materia_id;

INSERT INTO corso_di_recupero (
	codice,
	aula,
	docente_id,
	profilo_docente_id,
	anno_scolastico_id,
	materia_id
	)
VALUES (
	'ITALIANO_2',
	'ITA7',
	@docente_id,
	@profilo_docente_id,
	'1',
	@materia_id
);
SET @last_id_corso_di_recupero = LAST_INSERT_ID();

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-04',
	'14:00:00',
	2,
	'14:00-15:40',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-05',
	'14:00:00',
	2,
	'14:00-15:40',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-06',
	'14:00:00',
	2,
	'14:00-15:40',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-07',
	'14:00:00',
	2,
	'14:00-15:40',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-10',
	'14:00:00',
	2,
	'14:00-15:40',
	@last_id_corso_di_recupero
);

UPDATE corso_di_recupero
SET
	numero_ore=10
WHERE
	corso_di_recupero.id=@last_id_corso_di_recupero
;

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Santoro',
	'Silvia',
	'2LES',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Viola',
	'Samantha',
	'2LES',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Zadra',
	'Anna Maria',
	'2LES',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Perlot',
	'Sara',
	'TR-LES',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Spiro',
	'Enea',
	'2ITE',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Filippi',
	'Manuel',
	'TR AFM',
	@last_id_corso_di_recupero
);

INSERT INTO studente_partecipa_lezione_corso_di_recupero (
	lezione_corso_di_recupero_id,
	studente_per_corso_di_recupero_id
	)
SELECT lezione_corso_di_recupero.id, studente_per_corso_di_recupero.id 
FROM lezione_corso_di_recupero, studente_per_corso_di_recupero
WHERE
	lezione_corso_di_recupero.corso_di_recupero_id = @last_id_corso_di_recupero
AND
	studente_per_corso_di_recupero.corso_di_recupero_id = @last_id_corso_di_recupero
;


-- FISICA_3 - prende docente.id dal cognome Ianes
SELECT `id` FROM docente
WHERE docente.cognome='Ianes' LIMIT 1
INTO @docente_id;

-- prende profilo_docente.id dal id ricavato da cognome Ianes
SELECT `id` FROM profilo_docente
WHERE profilo_docente.anno_scolastico_id = '1'
	AND profilo_docente.docente_id = '39' LIMIT 1
INTO @profilo_docente_id;

-- prende materia.id dal codice Fis-T
SELECT `id` FROM materia
WHERE materia.codice='Fis-T' LIMIT 1
INTO @materia_id;

INSERT INTO corso_di_recupero (
	codice,
	aula,
	docente_id,
	profilo_docente_id,
	anno_scolastico_id,
	materia_id
	)
VALUES (
	'FISICA_3',
	'FIS1',
	@docente_id,
	@profilo_docente_id,
	'1',
	@materia_id
);
SET @last_id_corso_di_recupero = LAST_INSERT_ID();

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-04',
	'14:00:00',
	2,
	'14:00-15:40',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-05',
	'14:00:00',
	2,
	'14:00-15:40',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-06',
	'14:00:00',
	2,
	'14:00-15:40',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-07',
	'14:00:00',
	2,
	'14:00-15:40',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-10',
	'14:00:00',
	2,
	'14:00-15:40',
	@last_id_corso_di_recupero
);

UPDATE corso_di_recupero
SET
	numero_ore=10
WHERE
	corso_di_recupero.id=@last_id_corso_di_recupero
;

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Borzaga',
	'Leonardo',
	'1LOS4',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Castellan',
	'Bruno',
	'1LOS4',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Lorenzi',
	'Massimiliano',
	'1LOS4',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Rampanelli',
	'Angela***',
	'TR LOS4',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Salvadori',
	'Sara',
	'2LOS',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Bottamedi',
	'Federica',
	'2LISA',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Girardi',
	'Arianna',
	'2LISA',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Mucha',
	'Shpend',
	'2LISA',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Caset',
	'Sabrina',
	'2LISB',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Floriani',
	'Sofia',
	'2LISB',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Gorni',
	'Sabrina',
	'2LISB',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Franzoi',
	'Lorenzo',
	'2ITT',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Giacomuzzi',
	'Filippo',
	'2ITT',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Inama',
	'Eleonora',
	'2ITT',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Salvaterra',
	'Loris',
	'2ITT',
	@last_id_corso_di_recupero
);

INSERT INTO studente_partecipa_lezione_corso_di_recupero (
	lezione_corso_di_recupero_id,
	studente_per_corso_di_recupero_id
	)
SELECT lezione_corso_di_recupero.id, studente_per_corso_di_recupero.id 
FROM lezione_corso_di_recupero, studente_per_corso_di_recupero
WHERE
	lezione_corso_di_recupero.corso_di_recupero_id = @last_id_corso_di_recupero
AND
	studente_per_corso_di_recupero.corso_di_recupero_id = @last_id_corso_di_recupero
;


-- MATEMATICA_4 - prende docente.id dal cognome Casavecchia
SELECT `id` FROM docente
WHERE docente.cognome='Casavecchia' LIMIT 1
INTO @docente_id;

-- prende profilo_docente.id dal id ricavato da cognome Casavecchia
SELECT `id` FROM profilo_docente
WHERE profilo_docente.anno_scolastico_id = '1'
	AND profilo_docente.docente_id = '8' LIMIT 1
INTO @profilo_docente_id;

-- prende materia.id dal codice Mate
SELECT `id` FROM materia
WHERE materia.codice='Mate' LIMIT 1
INTO @materia_id;

INSERT INTO corso_di_recupero (
	codice,
	aula,
	docente_id,
	profilo_docente_id,
	anno_scolastico_id,
	materia_id
	)
VALUES (
	'MATEMATICA_4',
	'MAT1',
	@docente_id,
	@profilo_docente_id,
	'1',
	@materia_id
);
SET @last_id_corso_di_recupero = LAST_INSERT_ID();

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-04',
	'11:30:00',
	2,
	'11:30-13:10',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-05',
	'11:30:00',
	2,
	'11:30-13:10',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-06',
	'11:30:00',
	2,
	'11:30-13:10',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-07',
	'11:30:00',
	2,
	'11:30-13:10',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-10',
	'11:30:00',
	2,
	'11:30-13:10',
	@last_id_corso_di_recupero
);

UPDATE corso_di_recupero
SET
	numero_ore=10
WHERE
	corso_di_recupero.id=@last_id_corso_di_recupero
;

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Foniqi',
	'Djellze',
	'2LES',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Gashi',
	'Blerta',
	'2LES',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Hila',
	'Jessica',
	'2LES',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Miftari',
	'Arbenita',
	'2LES',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Santoro',
	'Silvia',
	'2LES',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Spaneshi',
	'Joana',
	'2LES',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Ciancimino',
	'Asia',
	'2ITE',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Consoli',
	'Nicola',
	'2ITE',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Guarracino',
	'Emily',
	'2ITE',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Rampazzo',
	'Denis',
	'2ITE',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Sandri',
	'Federico',
	'2ITE',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Franzoi',
	'Lorenzo',
	'2ITT',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Inama',
	'Eleonora',
	'2ITT',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Lombardi',
	'Diego',
	'2ITT',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Sissoko',
	'Arouna',
	'2ITT',
	@last_id_corso_di_recupero
);

INSERT INTO studente_partecipa_lezione_corso_di_recupero (
	lezione_corso_di_recupero_id,
	studente_per_corso_di_recupero_id
	)
SELECT lezione_corso_di_recupero.id, studente_per_corso_di_recupero.id 
FROM lezione_corso_di_recupero, studente_per_corso_di_recupero
WHERE
	lezione_corso_di_recupero.corso_di_recupero_id = @last_id_corso_di_recupero
AND
	studente_per_corso_di_recupero.corso_di_recupero_id = @last_id_corso_di_recupero
;


-- INGLESE_3 - prende docente.id dal cognome Dalbosco
SELECT `id` FROM docente
WHERE docente.cognome='Dalbosco' LIMIT 1
INTO @docente_id;

-- prende profilo_docente.id dal id ricavato da cognome Dalbosco
SELECT `id` FROM profilo_docente
WHERE profilo_docente.anno_scolastico_id = '1'
	AND profilo_docente.docente_id = '17' LIMIT 1
INTO @profilo_docente_id;

-- prende materia.id dal codice Ing-T
SELECT `id` FROM materia
WHERE materia.codice='Ing-T' LIMIT 1
INTO @materia_id;

INSERT INTO corso_di_recupero (
	codice,
	aula,
	docente_id,
	profilo_docente_id,
	anno_scolastico_id,
	materia_id
	)
VALUES (
	'INGLESE_3',
	'ING1',
	@docente_id,
	@profilo_docente_id,
	'1',
	@materia_id
);
SET @last_id_corso_di_recupero = LAST_INSERT_ID();

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-04',
	'9:45:00',
	2,
	'9:45-11:25',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-05',
	'9:45:00',
	2,
	'9:45-11:25',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-06',
	'9:45:00',
	2,
	'9:45-11:25',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-07',
	'9:45:00',
	2,
	'9:45-11:25',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-10',
	'9:45:00',
	2,
	'9:45-11:25',
	@last_id_corso_di_recupero
);

UPDATE corso_di_recupero
SET
	numero_ore=10
WHERE
	corso_di_recupero.id=@last_id_corso_di_recupero
;

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Valentinotti',
	'Alessio',
	'2LISB',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Spaneshi',
	'Joana',
	'2LES',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Zadra',
	'Anna Maria',
	'2LES',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Di_serio',
	'Aaron',
	'2ITE',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Perlot',
	'Sara',
	'TR-LES',
	@last_id_corso_di_recupero
);

INSERT INTO studente_partecipa_lezione_corso_di_recupero (
	lezione_corso_di_recupero_id,
	studente_per_corso_di_recupero_id
	)
SELECT lezione_corso_di_recupero.id, studente_per_corso_di_recupero.id 
FROM lezione_corso_di_recupero, studente_per_corso_di_recupero
WHERE
	lezione_corso_di_recupero.corso_di_recupero_id = @last_id_corso_di_recupero
AND
	studente_per_corso_di_recupero.corso_di_recupero_id = @last_id_corso_di_recupero
;


-- STORIA_2 - prende docente.id dal cognome Franzoi
SELECT `id` FROM docente
WHERE docente.cognome='Franzoi' LIMIT 1
INTO @docente_id;

-- prende profilo_docente.id dal id ricavato da cognome Franzoi
SELECT `id` FROM profilo_docente
WHERE profilo_docente.anno_scolastico_id = '1'
	AND profilo_docente.docente_id = '31' LIMIT 1
INTO @profilo_docente_id;

-- prende materia.id dal codice Sto
SELECT `id` FROM materia
WHERE materia.codice='Sto' LIMIT 1
INTO @materia_id;

INSERT INTO corso_di_recupero (
	codice,
	aula,
	docente_id,
	profilo_docente_id,
	anno_scolastico_id,
	materia_id
	)
VALUES (
	'STORIA_2',
	'ITA7',
	@docente_id,
	@profilo_docente_id,
	'1',
	@materia_id
);
SET @last_id_corso_di_recupero = LAST_INSERT_ID();

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-04',
	'9:45:00',
	2,
	'9:45-11:25',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-05',
	'9:45:00',
	2,
	'9:45-11:25',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-06',
	'9:45:00',
	2,
	'9:45-11:25',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-07',
	'9:45:00',
	2,
	'9:45-11:25',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-10',
	'9:45:00',
	2,
	'9:45-11:25',
	@last_id_corso_di_recupero
);

UPDATE corso_di_recupero
SET
	numero_ore=10
WHERE
	corso_di_recupero.id=@last_id_corso_di_recupero
;

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Santoro',
	'Tania',
	'2LES',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Viola',
	'Samantha',
	'2LES',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Sandri',
	'Federico',
	'2ITE',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Spiro',
	'Enea',
	'2ITE',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Giacomuzzi',
	'Filippo',
	'2ITT',
	@last_id_corso_di_recupero
);

INSERT INTO studente_partecipa_lezione_corso_di_recupero (
	lezione_corso_di_recupero_id,
	studente_per_corso_di_recupero_id
	)
SELECT lezione_corso_di_recupero.id, studente_per_corso_di_recupero.id 
FROM lezione_corso_di_recupero, studente_per_corso_di_recupero
WHERE
	lezione_corso_di_recupero.corso_di_recupero_id = @last_id_corso_di_recupero
AND
	studente_per_corso_di_recupero.corso_di_recupero_id = @last_id_corso_di_recupero
;


-- ECONOMIA AZIENDALE_1 - prende docente.id dal cognome Nicolussi
SELECT `id` FROM docente
WHERE docente.cognome='Nicolussi' LIMIT 1
INTO @docente_id;

-- prende profilo_docente.id dal id ricavato da cognome Nicolussi
SELECT `id` FROM profilo_docente
WHERE profilo_docente.anno_scolastico_id = '1'
	AND profilo_docente.docente_id = '54' LIMIT 1
INTO @profilo_docente_id;

-- prende materia.id dal codice Ec.Az
SELECT `id` FROM materia
WHERE materia.codice='Ec.Az' LIMIT 1
INTO @materia_id;

INSERT INTO corso_di_recupero (
	codice,
	aula,
	docente_id,
	profilo_docente_id,
	anno_scolastico_id,
	materia_id
	)
VALUES (
	'ECONOMIA AZIENDALE_1',
	'LAB EC.AZ.',
	@docente_id,
	@profilo_docente_id,
	'1',
	@materia_id
);
SET @last_id_corso_di_recupero = LAST_INSERT_ID();

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-04',
	'9:45:00',
	2,
	'9:45-11:25',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-05',
	'9:45:00',
	2,
	'9:45-11:25',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-06',
	'9:45:00',
	2,
	'9:45-11:25',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-07',
	'9:45:00',
	2,
	'9:45-11:25',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-10',
	'9:45:00',
	2,
	'9:45-11:25',
	@last_id_corso_di_recupero
);

UPDATE corso_di_recupero
SET
	numero_ore=10
WHERE
	corso_di_recupero.id=@last_id_corso_di_recupero
;

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Bompasso',
	'Salvatore Francesco',
	'1ITE',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Cappelletti',
	'Simone',
	'1ITE',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Dalfovo',
	'Nicol',
	'1ITE',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Stenico',
	'Sara',
	'1ITE',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Berto\'',
	'Giacomo***',
	'TR ITE',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Filippi',
	'Manuel***',
	'TR AFM',
	@last_id_corso_di_recupero
);

INSERT INTO studente_partecipa_lezione_corso_di_recupero (
	lezione_corso_di_recupero_id,
	studente_per_corso_di_recupero_id
	)
SELECT lezione_corso_di_recupero.id, studente_per_corso_di_recupero.id 
FROM lezione_corso_di_recupero, studente_per_corso_di_recupero
WHERE
	lezione_corso_di_recupero.corso_di_recupero_id = @last_id_corso_di_recupero
AND
	studente_per_corso_di_recupero.corso_di_recupero_id = @last_id_corso_di_recupero
;


-- MATEMATICA_5 - prende docente.id dal cognome Moratelli
SELECT `id` FROM docente
WHERE docente.cognome='Moratelli' LIMIT 1
INTO @docente_id;

-- prende profilo_docente.id dal id ricavato da cognome Moratelli
SELECT `id` FROM profilo_docente
WHERE profilo_docente.anno_scolastico_id = '1'
	AND profilo_docente.docente_id = '51' LIMIT 1
INTO @profilo_docente_id;

-- prende materia.id dal codice Mate
SELECT `id` FROM materia
WHERE materia.codice='Mate' LIMIT 1
INTO @materia_id;

INSERT INTO corso_di_recupero (
	codice,
	aula,
	docente_id,
	profilo_docente_id,
	anno_scolastico_id,
	materia_id
	)
VALUES (
	'MATEMATICA_5',
	'MAT6',
	@docente_id,
	@profilo_docente_id,
	'1',
	@materia_id
);
SET @last_id_corso_di_recupero = LAST_INSERT_ID();

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-04',
	'9:45:00',
	2,
	'9:45-11:25',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-05',
	'9:45:00',
	2,
	'9:45-11:25',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-06',
	'9:45:00',
	2,
	'9:45-11:25',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-07',
	'9:45:00',
	2,
	'9:45-11:25',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-10',
	'9:45:00',
	2,
	'9:45-11:25',
	@last_id_corso_di_recupero
);

UPDATE corso_di_recupero
SET
	numero_ore=10
WHERE
	corso_di_recupero.id=@last_id_corso_di_recupero
;

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Gavazza',
	'Marco',
	'3LOS',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Giuliani',
	'Edoardo',
	'3LOS',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Tait',
	'Leonardo',
	'3LOS',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Wegher',
	'Chiara',
	'3LOS',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Ilou',
	'Miriam',
	'3LISA',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Selber',
	'Salvadori Elia',
	'3LISA',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Bolech',
	'Alessia',
	'3LISB',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Bottamedi',
	'Nicolas',
	'3LISB',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Busana',
	'Samuel',
	'3LISB',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Donini',
	'Andrea',
	'3LISB',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Gadotti',
	'Alessandro',
	'3LISB',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Pedot',
	'Simone',
	'3LISB',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Ugolini',
	'Gianna',
	'3LISB',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Mazzucchi',
	'Marco',
	'TR LIS',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Garzetti',
	'Matilde*',
	'3LISA',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Pedron',
	'Mattia*',
	'3LISA',
	@last_id_corso_di_recupero
);

INSERT INTO studente_partecipa_lezione_corso_di_recupero (
	lezione_corso_di_recupero_id,
	studente_per_corso_di_recupero_id
	)
SELECT lezione_corso_di_recupero.id, studente_per_corso_di_recupero.id 
FROM lezione_corso_di_recupero, studente_per_corso_di_recupero
WHERE
	lezione_corso_di_recupero.corso_di_recupero_id = @last_id_corso_di_recupero
AND
	studente_per_corso_di_recupero.corso_di_recupero_id = @last_id_corso_di_recupero
;


-- TEDESCO_3 - prende docente.id dal cognome Onorino
SELECT `id` FROM docente
WHERE docente.cognome='Onorino' LIMIT 1
INTO @docente_id;

-- prende profilo_docente.id dal id ricavato da cognome Onorino
SELECT `id` FROM profilo_docente
WHERE profilo_docente.anno_scolastico_id = '1'
	AND profilo_docente.docente_id = '57' LIMIT 1
INTO @profilo_docente_id;

-- prende materia.id dal codice Ted-T
SELECT `id` FROM materia
WHERE materia.codice='Ted-T' LIMIT 1
INTO @materia_id;

INSERT INTO corso_di_recupero (
	codice,
	aula,
	docente_id,
	profilo_docente_id,
	anno_scolastico_id,
	materia_id
	)
VALUES (
	'TEDESCO_3',
	'TED2',
	@docente_id,
	@profilo_docente_id,
	'1',
	@materia_id
);
SET @last_id_corso_di_recupero = LAST_INSERT_ID();

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-04',
	'11:30:00',
	2,
	'11:30-13:10',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-05',
	'11:30:00',
	2,
	'11:30-13:10',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-06',
	'11:30:00',
	2,
	'11:30-13:10',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-07',
	'11:30:00',
	2,
	'11:30-13:10',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-10',
	'11:30:00',
	2,
	'11:30-13:10',
	@last_id_corso_di_recupero
);

UPDATE corso_di_recupero
SET
	numero_ore=10
WHERE
	corso_di_recupero.id=@last_id_corso_di_recupero
;

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Giacalone',
	'Vincenzo',
	'3LISA',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Grisenti',
	'Thomas',
	'3LISA',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Bottamedi',
	'Nicolas',
	'3LISB',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Borga',
	'Anna',
	'3LES',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Campestrini',
	'Davide',
	'3LES',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Hafili',
	'Khaoula',
	'3LES',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Toggi',
	'Alessia',
	'3LES',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Tonidandel',
	'Marianna',
	'3LES',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Paoli',
	'Elisabetta',
	'3AFM',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Garzetti',
	'Matilde*',
	'3LISA',
	@last_id_corso_di_recupero
);

INSERT INTO studente_partecipa_lezione_corso_di_recupero (
	lezione_corso_di_recupero_id,
	studente_per_corso_di_recupero_id
	)
SELECT lezione_corso_di_recupero.id, studente_per_corso_di_recupero.id 
FROM lezione_corso_di_recupero, studente_per_corso_di_recupero
WHERE
	lezione_corso_di_recupero.corso_di_recupero_id = @last_id_corso_di_recupero
AND
	studente_per_corso_di_recupero.corso_di_recupero_id = @last_id_corso_di_recupero
;


-- FISICA_4 - prende docente.id dal cognome Brugnara
SELECT `id` FROM docente
WHERE docente.cognome='Brugnara' LIMIT 1
INTO @docente_id;

-- prende profilo_docente.id dal id ricavato da cognome Brugnara
SELECT `id` FROM profilo_docente
WHERE profilo_docente.anno_scolastico_id = '1'
	AND profilo_docente.docente_id = '4' LIMIT 1
INTO @profilo_docente_id;

-- prende materia.id dal codice Fis-T
SELECT `id` FROM materia
WHERE materia.codice='Fis-T' LIMIT 1
INTO @materia_id;

INSERT INTO corso_di_recupero (
	codice,
	aula,
	docente_id,
	profilo_docente_id,
	anno_scolastico_id,
	materia_id
	)
VALUES (
	'FISICA_4',
	'MAT4',
	@docente_id,
	@profilo_docente_id,
	'1',
	@materia_id
);
SET @last_id_corso_di_recupero = LAST_INSERT_ID();

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-04',
	'8:00:00',
	2,
	'8:00-9:40',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-05',
	'8:00:00',
	2,
	'8:00-9:40',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-06',
	'8:00:00',
	2,
	'8:00-9:40',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-07',
	'8:00:00',
	2,
	'8:00-9:40',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-10',
	'8:00:00',
	2,
	'8:00-9:40',
	@last_id_corso_di_recupero
);

UPDATE corso_di_recupero
SET
	numero_ore=10
WHERE
	corso_di_recupero.id=@last_id_corso_di_recupero
;

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Giuliani',
	'Edoardo',
	'3LOS',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Santini',
	'Massimo',
	'3LOS',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Conti',
	'Luca',
	'3LISA',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Grisenti',
	'Thomas',
	'3LISA',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Ilou',
	'Miriam',
	'3LISA',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Selber',
	'Salvadori Elia',
	'3LISA',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Coster',
	'Comi Elena',
	'3LISB',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Ugolini',
	'Gianna',
	'3LISB',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Mazzucchi',
	'Marco',
	'TR LIS',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Garzetti',
	'Matilde*',
	'3LISA',
	@last_id_corso_di_recupero
);

INSERT INTO studente_partecipa_lezione_corso_di_recupero (
	lezione_corso_di_recupero_id,
	studente_per_corso_di_recupero_id
	)
SELECT lezione_corso_di_recupero.id, studente_per_corso_di_recupero.id 
FROM lezione_corso_di_recupero, studente_per_corso_di_recupero
WHERE
	lezione_corso_di_recupero.corso_di_recupero_id = @last_id_corso_di_recupero
AND
	studente_per_corso_di_recupero.corso_di_recupero_id = @last_id_corso_di_recupero
;


-- ECONOMIA AZIENDALE_2 - prende docente.id dal cognome Nicolussi
SELECT `id` FROM docente
WHERE docente.cognome='Nicolussi' LIMIT 1
INTO @docente_id;

-- prende profilo_docente.id dal id ricavato da cognome Nicolussi
SELECT `id` FROM profilo_docente
WHERE profilo_docente.anno_scolastico_id = '1'
	AND profilo_docente.docente_id = '54' LIMIT 1
INTO @profilo_docente_id;

-- prende materia.id dal codice Ec.Az
SELECT `id` FROM materia
WHERE materia.codice='Ec.Az' LIMIT 1
INTO @materia_id;

INSERT INTO corso_di_recupero (
	codice,
	aula,
	docente_id,
	profilo_docente_id,
	anno_scolastico_id,
	materia_id
	)
VALUES (
	'ECONOMIA AZIENDALE_2',
	'LAB EC. AZ',
	@docente_id,
	@profilo_docente_id,
	'1',
	@materia_id
);
SET @last_id_corso_di_recupero = LAST_INSERT_ID();

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-04',
	'8:00:00',
	2,
	'8:00-9:40',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-05',
	'8:00:00',
	2,
	'8:00-9:40',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-06',
	'8:00:00',
	2,
	'8:00-9:40',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-07',
	'8:00:00',
	2,
	'8:00-9:40',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-10',
	'8:00:00',
	2,
	'8:00-9:40',
	@last_id_corso_di_recupero
);

UPDATE corso_di_recupero
SET
	numero_ore=10
WHERE
	corso_di_recupero.id=@last_id_corso_di_recupero
;

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Nadeem',
	'Kainat',
	'3AFM',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Paoli',
	'Elisabetta',
	'3AFM',
	@last_id_corso_di_recupero
);

INSERT INTO studente_partecipa_lezione_corso_di_recupero (
	lezione_corso_di_recupero_id,
	studente_per_corso_di_recupero_id
	)
SELECT lezione_corso_di_recupero.id, studente_per_corso_di_recupero.id 
FROM lezione_corso_di_recupero, studente_per_corso_di_recupero
WHERE
	lezione_corso_di_recupero.corso_di_recupero_id = @last_id_corso_di_recupero
AND
	studente_per_corso_di_recupero.corso_di_recupero_id = @last_id_corso_di_recupero
;


-- MATEMATICA_6 - prende docente.id dal cognome Comai
SELECT `id` FROM docente
WHERE docente.cognome='Comai' LIMIT 1
INTO @docente_id;

-- prende profilo_docente.id dal id ricavato da cognome Comai
SELECT `id` FROM profilo_docente
WHERE profilo_docente.anno_scolastico_id = '1'
	AND profilo_docente.docente_id = '10' LIMIT 1
INTO @profilo_docente_id;

-- prende materia.id dal codice Mate
SELECT `id` FROM materia
WHERE materia.codice='Mate' LIMIT 1
INTO @materia_id;

INSERT INTO corso_di_recupero (
	codice,
	aula,
	docente_id,
	profilo_docente_id,
	anno_scolastico_id,
	materia_id
	)
VALUES (
	'MATEMATICA_6',
	'MAT5',
	@docente_id,
	@profilo_docente_id,
	'1',
	@materia_id
);
SET @last_id_corso_di_recupero = LAST_INSERT_ID();

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-04',
	'9:45:00',
	2,
	'9:45-11:25',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-05',
	'9:45:00',
	2,
	'9:45-11:25',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-06',
	'9:45:00',
	2,
	'9:45-11:25',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-07',
	'9:45:00',
	2,
	'9:45-11:25',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-10',
	'9:45:00',
	2,
	'9:45-11:25',
	@last_id_corso_di_recupero
);

UPDATE corso_di_recupero
SET
	numero_ore=10
WHERE
	corso_di_recupero.id=@last_id_corso_di_recupero
;

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Borga',
	'Anna',
	'3LES',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Namane',
	'Maroua',
	'3LES',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Colombini',
	'Martina',
	'3AFM',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Paoli',
	'Elisabetta',
	'3AFM',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Bonomi',
	'Thomas',
	'3CM',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Agyabeng',
	'Harrigan',
	'3TL',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Bargan',
	'Mircea Bogdan',
	'3TL',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Segheir',
	'Amine',
	'3TL',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Zeni',
	'Martin',
	'3TL',
	@last_id_corso_di_recupero
);

INSERT INTO studente_partecipa_lezione_corso_di_recupero (
	lezione_corso_di_recupero_id,
	studente_per_corso_di_recupero_id
	)
SELECT lezione_corso_di_recupero.id, studente_per_corso_di_recupero.id 
FROM lezione_corso_di_recupero, studente_per_corso_di_recupero
WHERE
	lezione_corso_di_recupero.corso_di_recupero_id = @last_id_corso_di_recupero
AND
	studente_per_corso_di_recupero.corso_di_recupero_id = @last_id_corso_di_recupero
;


-- INGLESE_4 - prende docente.id dal cognome Dalbosco
SELECT `id` FROM docente
WHERE docente.cognome='Dalbosco' LIMIT 1
INTO @docente_id;

-- prende profilo_docente.id dal id ricavato da cognome Dalbosco
SELECT `id` FROM profilo_docente
WHERE profilo_docente.anno_scolastico_id = '1'
	AND profilo_docente.docente_id = '17' LIMIT 1
INTO @profilo_docente_id;

-- prende materia.id dal codice Ing-T
SELECT `id` FROM materia
WHERE materia.codice='Ing-T' LIMIT 1
INTO @materia_id;

INSERT INTO corso_di_recupero (
	codice,
	aula,
	docente_id,
	profilo_docente_id,
	anno_scolastico_id,
	materia_id
	)
VALUES (
	'INGLESE_4',
	'ING1',
	@docente_id,
	@profilo_docente_id,
	'1',
	@materia_id
);
SET @last_id_corso_di_recupero = LAST_INSERT_ID();

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-04',
	'14:00:00',
	2,
	'14:00-15:40',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-05',
	'14:00:00',
	2,
	'14:00-15:40',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-06',
	'14:00:00',
	2,
	'14:00-15:40',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-07',
	'14:00:00',
	2,
	'14:00-15:40',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-10',
	'14:00:00',
	2,
	'14:00-15:40',
	@last_id_corso_di_recupero
);

UPDATE corso_di_recupero
SET
	numero_ore=10
WHERE
	corso_di_recupero.id=@last_id_corso_di_recupero
;

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Giacalone',
	'Vincenzo',
	'3LISA',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Grisenti',
	'Thomas',
	'3LISA',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Marcon',
	'Michele',
	'3LISB',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Devigili',
	'Giorgia',
	'3AFM',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Bargan',
	'Mircea Bogdan',
	'3TL',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Mazzucchi',
	'Marco',
	'TR LIS',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Paternoster',
	'Mattia*',
	'3LISA',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Pasolli',
	'Silvia*',
	'3AFM',
	@last_id_corso_di_recupero
);

INSERT INTO studente_partecipa_lezione_corso_di_recupero (
	lezione_corso_di_recupero_id,
	studente_per_corso_di_recupero_id
	)
SELECT lezione_corso_di_recupero.id, studente_per_corso_di_recupero.id 
FROM lezione_corso_di_recupero, studente_per_corso_di_recupero
WHERE
	lezione_corso_di_recupero.corso_di_recupero_id = @last_id_corso_di_recupero
AND
	studente_per_corso_di_recupero.corso_di_recupero_id = @last_id_corso_di_recupero
;


-- ITALIANO_3 - prende docente.id dal cognome Caroli
SELECT `id` FROM docente
WHERE docente.cognome='Caroli' LIMIT 1
INTO @docente_id;

-- prende profilo_docente.id dal id ricavato da cognome Caroli
SELECT `id` FROM profilo_docente
WHERE profilo_docente.anno_scolastico_id = '1'
	AND profilo_docente.docente_id = '7' LIMIT 1
INTO @profilo_docente_id;

-- prende materia.id dal codice Ita
SELECT `id` FROM materia
WHERE materia.codice='Ita' LIMIT 1
INTO @materia_id;

INSERT INTO corso_di_recupero (
	codice,
	aula,
	docente_id,
	profilo_docente_id,
	anno_scolastico_id,
	materia_id
	)
VALUES (
	'ITALIANO_3',
	'ITA5',
	@docente_id,
	@profilo_docente_id,
	'1',
	@materia_id
);
SET @last_id_corso_di_recupero = LAST_INSERT_ID();

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-04',
	'8:00:00',
	2,
	'8:00-9:40',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-05',
	'8:00:00',
	2,
	'8:00-9:40',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-06',
	'8:00:00',
	2,
	'8:00-9:40',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-07',
	'8:00:00',
	2,
	'8:00-9:40',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-10',
	'8:00:00',
	2,
	'8:00-9:40',
	@last_id_corso_di_recupero
);

UPDATE corso_di_recupero
SET
	numero_ore=10
WHERE
	corso_di_recupero.id=@last_id_corso_di_recupero
;

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Menapace',
	'Davide',
	'3LISA',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Facci',
	'Barbara',
	'3LES',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Bargan',
	'Mircea Bogdan',
	'3TL',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Zeni',
	'Martin',
	'3TL',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Menegatti',
	'Nicola',
	'4 TL',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Paternoster',
	'Mattia*',
	'3LISA',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Pedron',
	'Mattia*',
	'3LISA',
	@last_id_corso_di_recupero
);

INSERT INTO studente_partecipa_lezione_corso_di_recupero (
	lezione_corso_di_recupero_id,
	studente_per_corso_di_recupero_id
	)
SELECT lezione_corso_di_recupero.id, studente_per_corso_di_recupero.id 
FROM lezione_corso_di_recupero, studente_per_corso_di_recupero
WHERE
	lezione_corso_di_recupero.corso_di_recupero_id = @last_id_corso_di_recupero
AND
	studente_per_corso_di_recupero.corso_di_recupero_id = @last_id_corso_di_recupero
;


-- MATEMATICA_7 - prende docente.id dal cognome Zambonato
SELECT `id` FROM docente
WHERE docente.cognome='Zambonato' LIMIT 1
INTO @docente_id;

-- prende profilo_docente.id dal id ricavato da cognome Zambonato
SELECT `id` FROM profilo_docente
WHERE profilo_docente.anno_scolastico_id = '1'
	AND profilo_docente.docente_id = '91' LIMIT 1
INTO @profilo_docente_id;

-- prende materia.id dal codice Mate
SELECT `id` FROM materia
WHERE materia.codice='Mate' LIMIT 1
INTO @materia_id;

INSERT INTO corso_di_recupero (
	codice,
	aula,
	docente_id,
	profilo_docente_id,
	anno_scolastico_id,
	materia_id
	)
VALUES (
	'MATEMATICA_7',
	'MAT5',
	@docente_id,
	@profilo_docente_id,
	'1',
	@materia_id
);
SET @last_id_corso_di_recupero = LAST_INSERT_ID();

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-04',
	'11:30:00',
	2,
	'11:30-13:10',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-05',
	'11:30:00',
	2,
	'11:30-13:10',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-06',
	'11:30:00',
	2,
	'11:30-13:10',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-07',
	'11:30:00',
	2,
	'11:30-13:10',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-10',
	'11:30:00',
	2,
	'11:30-13:10',
	@last_id_corso_di_recupero
);

UPDATE corso_di_recupero
SET
	numero_ore=10
WHERE
	corso_di_recupero.id=@last_id_corso_di_recupero
;

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Devigili',
	'Sabrin',
	'4LES',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Pilati',
	'Arianna',
	'4LES',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Girardi',
	'Giulio',
	'4AFM',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Zatelli',
	'Martina',
	'4AFM',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Singh',
	'Balraj',
	'4 TL',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Toscani',
	'Daniele',
	'4 TL',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Cova',
	'Tiziano Silvio*',
	'4LOS',
	@last_id_corso_di_recupero
);

INSERT INTO studente_partecipa_lezione_corso_di_recupero (
	lezione_corso_di_recupero_id,
	studente_per_corso_di_recupero_id
	)
SELECT lezione_corso_di_recupero.id, studente_per_corso_di_recupero.id 
FROM lezione_corso_di_recupero, studente_per_corso_di_recupero
WHERE
	lezione_corso_di_recupero.corso_di_recupero_id = @last_id_corso_di_recupero
AND
	studente_per_corso_di_recupero.corso_di_recupero_id = @last_id_corso_di_recupero
;


-- TEDESCO_4 - prende docente.id dal cognome Maranzi
SELECT `id` FROM docente
WHERE docente.cognome='Maranzi' LIMIT 1
INTO @docente_id;

-- prende profilo_docente.id dal id ricavato da cognome Maranzi
SELECT `id` FROM profilo_docente
WHERE profilo_docente.anno_scolastico_id = '1'
	AND profilo_docente.docente_id = '48' LIMIT 1
INTO @profilo_docente_id;

-- prende materia.id dal codice Ted-T
SELECT `id` FROM materia
WHERE materia.codice='Ted-T' LIMIT 1
INTO @materia_id;

INSERT INTO corso_di_recupero (
	codice,
	aula,
	docente_id,
	profilo_docente_id,
	anno_scolastico_id,
	materia_id
	)
VALUES (
	'TEDESCO_4',
	'TED1',
	@docente_id,
	@profilo_docente_id,
	'1',
	@materia_id
);
SET @last_id_corso_di_recupero = LAST_INSERT_ID();

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-05',
	'9:45:00',
	2,
	'9:45-11:25',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-06',
	'9:45:00',
	2,
	'9:45-11:25',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-07',
	'9:45:00',
	2,
	'9:45-11:25',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-10',
	'9:45:00',
	2,
	'9:45-11:25',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-11',
	'9:45:00',
	2,
	'9:45-11:25',
	@last_id_corso_di_recupero
);

UPDATE corso_di_recupero
SET
	numero_ore=10
WHERE
	corso_di_recupero.id=@last_id_corso_di_recupero
;

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Agostini',
	'Sara',
	'4LES',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Campagnolo',
	'Valentina',
	'4LES',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Pilati',
	'Arianna',
	'4LES',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Ridolfi',
	'Alice',
	'4LES',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Segheir',
	'Meriem',
	'4LES',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Zenoniani',
	'Giorgia',
	'4LES',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Zatelli',
	'Martina',
	'4AFM',
	@last_id_corso_di_recupero
);

INSERT INTO studente_partecipa_lezione_corso_di_recupero (
	lezione_corso_di_recupero_id,
	studente_per_corso_di_recupero_id
	)
SELECT lezione_corso_di_recupero.id, studente_per_corso_di_recupero.id 
FROM lezione_corso_di_recupero, studente_per_corso_di_recupero
WHERE
	lezione_corso_di_recupero.corso_di_recupero_id = @last_id_corso_di_recupero
AND
	studente_per_corso_di_recupero.corso_di_recupero_id = @last_id_corso_di_recupero
;


-- ECONOMIA AZIENDALE_3 - prende docente.id dal cognome Buffi
SELECT `id` FROM docente
WHERE docente.cognome='Buffi' LIMIT 1
INTO @docente_id;

-- prende profilo_docente.id dal id ricavato da cognome Buffi
SELECT `id` FROM profilo_docente
WHERE profilo_docente.anno_scolastico_id = '1'
	AND profilo_docente.docente_id = '5' LIMIT 1
INTO @profilo_docente_id;

-- prende materia.id dal codice Ec.Az
SELECT `id` FROM materia
WHERE materia.codice='Ec.Az' LIMIT 1
INTO @materia_id;

INSERT INTO corso_di_recupero (
	codice,
	aula,
	docente_id,
	profilo_docente_id,
	anno_scolastico_id,
	materia_id
	)
VALUES (
	'ECONOMIA AZIENDALE_3',
	'EC. AZ1',
	@docente_id,
	@profilo_docente_id,
	'1',
	@materia_id
);
SET @last_id_corso_di_recupero = LAST_INSERT_ID();

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-04',
	'8:00:00',
	2,
	'8:00-9:40',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-05',
	'8:00:00',
	2,
	'8:00-9:40',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-06',
	'8:00:00',
	2,
	'8:00-9:40',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-07',
	'8:00:00',
	2,
	'8:00-9:40',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-10',
	'8:00:00',
	2,
	'8:00-9:40',
	@last_id_corso_di_recupero
);

UPDATE corso_di_recupero
SET
	numero_ore=10
WHERE
	corso_di_recupero.id=@last_id_corso_di_recupero
;

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Bhuiyan',
	'Mohammed Omar Hossain',
	'4AFM',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Gasperat',
	'Francesco',
	'4AFM',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Girardi',
	'Giulio',
	'4AFM',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Guida',
	'Vincenzo',
	'4AFM',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Maggiore',
	'Daria',
	'4AFM',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Sallata',
	'Albana',
	'4AFM',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Zatelli',
	'Martina',
	'4AFM',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Zeni',
	'Nicole',
	'4AFM',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Zeni',
	'Elisa***',
	'4AFM',
	@last_id_corso_di_recupero
);

INSERT INTO studente_partecipa_lezione_corso_di_recupero (
	lezione_corso_di_recupero_id,
	studente_per_corso_di_recupero_id
	)
SELECT lezione_corso_di_recupero.id, studente_per_corso_di_recupero.id 
FROM lezione_corso_di_recupero, studente_per_corso_di_recupero
WHERE
	lezione_corso_di_recupero.corso_di_recupero_id = @last_id_corso_di_recupero
AND
	studente_per_corso_di_recupero.corso_di_recupero_id = @last_id_corso_di_recupero
;


-- INGLESE_5 - prende docente.id dal cognome Spina
SELECT `id` FROM docente
WHERE docente.cognome='Spina' LIMIT 1
INTO @docente_id;

-- prende profilo_docente.id dal id ricavato da cognome Spina
SELECT `id` FROM profilo_docente
WHERE profilo_docente.anno_scolastico_id = '1'
	AND profilo_docente.docente_id = '80' LIMIT 1
INTO @profilo_docente_id;

-- prende materia.id dal codice Ing-T
SELECT `id` FROM materia
WHERE materia.codice='Ing-T' LIMIT 1
INTO @materia_id;

INSERT INTO corso_di_recupero (
	codice,
	aula,
	docente_id,
	profilo_docente_id,
	anno_scolastico_id,
	materia_id
	)
VALUES (
	'INGLESE_5',
	'ING2',
	@docente_id,
	@profilo_docente_id,
	'1',
	@materia_id
);
SET @last_id_corso_di_recupero = LAST_INSERT_ID();

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-04',
	'9:45:00',
	2,
	'9:45-11:25',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-05',
	'9:45:00',
	2,
	'9:45-11:25',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-06',
	'9:45:00',
	2,
	'9:45-11:25',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-07',
	'9:45:00',
	2,
	'9:45-11:25',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-10',
	'9:45:00',
	2,
	'9:45-11:25',
	@last_id_corso_di_recupero
);

UPDATE corso_di_recupero
SET
	numero_ore=10
WHERE
	corso_di_recupero.id=@last_id_corso_di_recupero
;

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Guadagnini',
	'Helena',
	'4LOS',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Malferrari',
	'Giada',
	'4LOS',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Marinconz',
	'Samuele',
	'4LOS',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Zadra',
	'Anna',
	'4LOS',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Maggiore',
	'Daria',
	'4AFM',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Zeni',
	'Elisa***',
	'4AFM',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Cova',
	'Tiziano Silvio*',
	'4LOS',
	@last_id_corso_di_recupero
);

INSERT INTO studente_partecipa_lezione_corso_di_recupero (
	lezione_corso_di_recupero_id,
	studente_per_corso_di_recupero_id
	)
SELECT lezione_corso_di_recupero.id, studente_per_corso_di_recupero.id 
FROM lezione_corso_di_recupero, studente_per_corso_di_recupero
WHERE
	lezione_corso_di_recupero.corso_di_recupero_id = @last_id_corso_di_recupero
AND
	studente_per_corso_di_recupero.corso_di_recupero_id = @last_id_corso_di_recupero
;


-- FISICA 5 - prende docente.id dal cognome Brugnara
SELECT `id` FROM docente
WHERE docente.cognome='Brugnara' LIMIT 1
INTO @docente_id;

-- prende profilo_docente.id dal id ricavato da cognome Brugnara
SELECT `id` FROM profilo_docente
WHERE profilo_docente.anno_scolastico_id = '1'
	AND profilo_docente.docente_id = '4' LIMIT 1
INTO @profilo_docente_id;

-- prende materia.id dal codice Fis-T
SELECT `id` FROM materia
WHERE materia.codice='Fis-T' LIMIT 1
INTO @materia_id;

INSERT INTO corso_di_recupero (
	codice,
	aula,
	docente_id,
	profilo_docente_id,
	anno_scolastico_id,
	materia_id
	)
VALUES (
	'FISICA 5',
	'MAT4',
	@docente_id,
	@profilo_docente_id,
	'1',
	@materia_id
);
SET @last_id_corso_di_recupero = LAST_INSERT_ID();

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-04',
	'11:30:00',
	2,
	'11:30-13:10',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-05',
	'11:30:00',
	2,
	'11:30-13:10',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-06',
	'11:30:00',
	2,
	'11:30-13:10',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-07',
	'11:30:00',
	2,
	'11:30-13:10',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-10',
	'11:30:00',
	2,
	'11:30-13:10',
	@last_id_corso_di_recupero
);

UPDATE corso_di_recupero
SET
	numero_ore=10
WHERE
	corso_di_recupero.id=@last_id_corso_di_recupero
;

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Guadagnini',
	'Helena',
	'4LOS',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Malferrari',
	'Giada',
	'4LOS',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Marinconz',
	'Samuele',
	'4LOS',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Ress',
	'Giorgia',
	'4LOS',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Cova',
	'Tiziano Silvio*',
	'4LOS',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Zadra',
	'Anna*',
	'4LOS',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Tanel',
	'Silvia*',
	'4LS',
	@last_id_corso_di_recupero
);

INSERT INTO studente_partecipa_lezione_corso_di_recupero (
	lezione_corso_di_recupero_id,
	studente_per_corso_di_recupero_id
	)
SELECT lezione_corso_di_recupero.id, studente_per_corso_di_recupero.id 
FROM lezione_corso_di_recupero, studente_per_corso_di_recupero
WHERE
	lezione_corso_di_recupero.corso_di_recupero_id = @last_id_corso_di_recupero
AND
	studente_per_corso_di_recupero.corso_di_recupero_id = @last_id_corso_di_recupero
;


-- COSMOLOGIA_1 - prende docente.id dal cognome Scapin
SELECT `id` FROM docente
WHERE docente.cognome='Scapin' LIMIT 1
INTO @docente_id;

-- prende profilo_docente.id dal id ricavato da cognome Scapin
SELECT `id` FROM profilo_docente
WHERE profilo_docente.anno_scolastico_id = '1'
	AND profilo_docente.docente_id = '72' LIMIT 1
INTO @profilo_docente_id;

-- prende materia.id dal codice Fis-T
SELECT `id` FROM materia
WHERE materia.codice='Fis-T' LIMIT 1
INTO @materia_id;

INSERT INTO corso_di_recupero (
	codice,
	aula,
	docente_id,
	profilo_docente_id,
	anno_scolastico_id,
	materia_id
	)
VALUES (
	'COSMOLOGIA_1',
	'ATRIO',
	@docente_id,
	@profilo_docente_id,
	'1',
	@materia_id
);
SET @last_id_corso_di_recupero = LAST_INSERT_ID();

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-08-18',
	'11:30:00',
	2,
	'11:30-13:10',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-08-19',
	'11:30:00',
	2,
	'11:30-13:10',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-08-20',
	'11:30:00',
	2,
	'11:30-13:10',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-08-21',
	'11:30:00',
	2,
	'11:30-13:10',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-08-22',
	'11:30:00',
	2,
	'11:30-13:10',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-08-23',
	'11:30:00',
	2,
	'11:30-13:10',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-08-24',
	'11:30:00',
	2,
	'11:30-13:10',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-08-25',
	'11:30:00',
	2,
	'11:30-13:10',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-08-26',
	'11:30:00',
	2,
	'11:30-13:10',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-08-27',
	'11:30:00',
	2,
	'11:30-13:10',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-08-28',
	'11:30:00',
	2,
	'11:30-13:10',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-08-29',
	'11:30:00',
	2,
	'11:30-13:10',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-08-30',
	'11:30:00',
	2,
	'11:30-13:10',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-01',
	'11:30:00',
	2,
	'11:30-13:10',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-02',
	'11:30:00',
	2,
	'11:30-13:10',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-03',
	'11:30:00',
	2,
	'11:30-13:10',
	@last_id_corso_di_recupero
);

UPDATE corso_di_recupero
SET
	numero_ore=32
WHERE
	corso_di_recupero.id=@last_id_corso_di_recupero
;

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Guadagnini',
	'Helena',
	'4LOS',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Malferrari',
	'Giada',
	'4LOS',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Marinconz',
	'Samuele',
	'4LOS',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Ress',
	'Giorgia',
	'4LOS',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Cova',
	'Tiziano Silvio*',
	'4LOS',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Zadra',
	'Anna*',
	'4LOS',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Tanel',
	'Silvia*',
	'4LS',
	@last_id_corso_di_recupero
);

INSERT INTO studente_partecipa_lezione_corso_di_recupero (
	lezione_corso_di_recupero_id,
	studente_per_corso_di_recupero_id
	)
SELECT lezione_corso_di_recupero.id, studente_per_corso_di_recupero.id 
FROM lezione_corso_di_recupero, studente_per_corso_di_recupero
WHERE
	lezione_corso_di_recupero.corso_di_recupero_id = @last_id_corso_di_recupero
AND
	studente_per_corso_di_recupero.corso_di_recupero_id = @last_id_corso_di_recupero
;


-- EURISTICA_1 - prende docente.id dal cognome Scapin
SELECT `id` FROM docente
WHERE docente.cognome='Scapin' LIMIT 1
INTO @docente_id;

-- prende profilo_docente.id dal id ricavato da cognome Scapin
SELECT `id` FROM profilo_docente
WHERE profilo_docente.anno_scolastico_id = '1'
	AND profilo_docente.docente_id = '72' LIMIT 1
INTO @profilo_docente_id;

-- prende materia.id dal codice Mate
SELECT `id` FROM materia
WHERE materia.codice='Mate' LIMIT 1
INTO @materia_id;

INSERT INTO corso_di_recupero (
	codice,
	aula,
	docente_id,
	profilo_docente_id,
	anno_scolastico_id,
	materia_id
	)
VALUES (
	'EURISTICA_1',
	'ATRIO',
	@docente_id,
	@profilo_docente_id,
	'1',
	@materia_id
);
SET @last_id_corso_di_recupero = LAST_INSERT_ID();

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-08-18',
	'9:30:00',
	2,
	'9:30-11:10',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-08-19',
	'9:30:00',
	2,
	'9:30-11:10',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-08-20',
	'9:30:00',
	2,
	'9:30-11:10',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-08-21',
	'9:30:00',
	2,
	'9:30-11:10',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-08-22',
	'9:30:00',
	2,
	'9:30-11:10',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-08-23',
	'9:30:00',
	2,
	'9:30-11:10',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-08-24',
	'9:30:00',
	2,
	'9:30-11:10',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-08-25',
	'9:30:00',
	2,
	'9:30-11:10',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-08-26',
	'9:30:00',
	2,
	'9:30-11:10',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-08-27',
	'9:30:00',
	2,
	'9:30-11:10',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-08-28',
	'9:30:00',
	2,
	'9:30-11:10',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-08-29',
	'9:30:00',
	2,
	'9:30-11:10',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-08-30',
	'9:30:00',
	2,
	'9:30-11:10',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-01',
	'9:30:00',
	2,
	'9:30-11:10',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-02',
	'9:30:00',
	2,
	'9:30-11:10',
	@last_id_corso_di_recupero
);

INSERT INTO lezione_corso_di_recupero (
	data,
	inizia_alle,
	numero_ore,
	orario,
	corso_di_recupero_id
	)
VALUES (
	'2018-09-03',
	'9:30:00',
	2,
	'9:30-11:10',
	@last_id_corso_di_recupero
);

UPDATE corso_di_recupero
SET
	numero_ore=32
WHERE
	corso_di_recupero.id=@last_id_corso_di_recupero
;

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Endrizzi',
	'Anna',
	'1LOS',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Fellin',
	'Sebastiano',
	'1LISA',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Battaini',
	'Clara',
	'1LES',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Dello-russo',
	'Irene',
	'1LES',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Tonon',
	'Andrea',
	'1LES',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Cappelletti',
	'Simone',
	'1ITE',
	@last_id_corso_di_recupero
);

INSERT INTO studente_per_corso_di_recupero (
	cognome,
	nome,
	classe,
	corso_di_recupero_id
	)
VALUES (
	'Faggiani',
	'Giovanni',
	'1ITE',
	@last_id_corso_di_recupero
);

INSERT INTO studente_partecipa_lezione_corso_di_recupero (
	lezione_corso_di_recupero_id,
	studente_per_corso_di_recupero_id
	)
SELECT lezione_corso_di_recupero.id, studente_per_corso_di_recupero.id 
FROM lezione_corso_di_recupero, studente_per_corso_di_recupero
WHERE
	lezione_corso_di_recupero.corso_di_recupero_id = @last_id_corso_di_recupero
AND
	studente_per_corso_di_recupero.corso_di_recupero_id = @last_id_corso_di_recupero
;

