<?php

	include("class.googlesheet.php");
	include("class.sentence.php");	
	include("class.word.php");
	
	include("connex.php");

	// CREATION DE LA TABLE D'INDEX ET DU CACHE S'IL N'EXISTE PAS
	$gsheet = new GoogleSheet("https://docs.google.com/spreadsheets/d/1-8VrVG5YeTYLUXb-Y9v2cHdtTApO8qLu4PDtOkKquww/edit#gid=0");
	$gid_table = $gsheet->getGidTable();

	/* CREATION COUV  */
	$couv_obj = new Sentence($gid_table,"couv",5,29);
	$couv_id = $couv_obj->getSentenceId();
	$couv_string = $couv_obj->getSentenceString();
	
	/* CREATION DE LA UNE  */
	$une_obj = new Sentence($gid_table,"une",5,34);
	$une_id = $une_obj->getSentenceId();
	$une_string = $une_obj->getSentenceString();
	
	/* CREATION DE L'ARTICLE 1  */
	$article1_obj = new Sentence($gid_table,"titre-article",5,47);
	$article1_id = $article1_obj->getSentenceId();
	$article1_string = $article1_obj->getSentenceString();
	
	/* CREATION DE L'ARTICLE 2  */
	$article2_obj = new Sentence($gid_table,"titre-article",5,47);
	$article2_id = $article2_obj->getSentenceId();
	$article2_string = $article2_obj->getSentenceString();
	
	/* CREATION DU TITRE DU QUIZ  */
	$quiz_obj = new Sentence($gid_table,"titre-quiz",5,28);
	$quiz_id = $quiz_obj->getSentenceId();
	$quiz_string = $quiz_obj->getSentenceString();
	
	$hash = hash('md5',$une_string); // Génère le hash

	/* ENREGISTREMENT DANS LA BDD */
	$bdd = database_connect();
	$ip = $_SERVER["REMOTE_ADDR"];
	$bdd->query('INSERT INTO magazines (hash,couv_filename,une,article1,article2,quiz,ip) VALUES("'.$hash.'","'.$couv_string.'","'.$une_string.'","'.$article1_string.'","'.$article2_string.'","'.$quiz_string.'","'.$ip.'")');

	/* AFFCIHAGE SOUS FORME D'OBJET JSON POUR AJAX */
	$data = [
		'hash' => $hash,
		'couv' => $couv_string,
		'une' => $une_string,
		'article1' => $article1_string,
		'article2' => $article2_string,
		'quiz' => $quiz_string
	];
	$jsonData = json_encode($data); // encode in a JSON object
	echo $jsonData;

?>