<?php

$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; // used by header metas
include("connect.php");

// RECUPERATION DES DONNEES EN CAS DE CHARGEMENT DE LA PAGE AVEC HASH
if(isset($_GET['hash']) && $_GET['hash']!='') { // Si on recoit un hash
	$hash = $_GET['hash'];
	$bdd = database_connect();
	$req = $bdd->query("SELECT couv_filename,une,article1,article2,quiz,ip FROM magazines WHERE hash='".$hash."'");
	$rep = $req->fetchAll();
	$couv_string= $rep[0]['couv_filename'];
	$une_string= $rep[0]['une'];
	$article1_string= $rep[0]['article1'];
	$article2_string= $rep[0]['article2'];
	$quiz_string= $rep[0]['quiz'];
}
else { // SINON, CREATION DU MAGAZINE
	include("class.googlesheet.php");
	include("class.sentence.php");	
	include("class.word.php");
	
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
	
	/* CREATION DU QUIZ  */
	$quiz_obj = new Sentence($gid_table,"titre-quiz",5,28);
	$quiz_id = $quiz_obj->getSentenceId();
	$quiz_string = $quiz_obj->getSentenceString();

	$hash = hash('md5',$une_string); // Génère le hash
	// $url = str_replace(' ', '-', strip_tags($une_string));

	/* ENREGISTREMENT DANS LA BDD */
	$bdd = database_connect();
	$ip = $_SERVER["REMOTE_ADDR"];
	$bdd->query('INSERT INTO magazines (hash,couv_filename,une,article1,article2,quiz,ip) VALUES("'.$hash.'","'.$couv_string.'","'.$une_string.'","'.$article1_string.'","'.$article2_string.'","'.$quiz_string.'","'.$ip.'")');

	// REDIRECTION VERS PAGE CREEE
	header("Location: ".$hash.".html");
	die();
	
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
	<?php include("header.php"); ?>
</head>

<body onload="setHeight()" onClick="window.location.href='index.php'">

<script>
	function setHeight() {
		$("#iphone-wrapper").width(($("#iphone-wrapper").height())*52/100);
	};
</script>

<div id="iphone-wrapper">
	<div id="couv" style="background-image:url('photos/<?php echo $couv_string; ?>')" />
		<h1><span class="big_h1">Michel Drucker</span>e-magazine</h1>
		<div class="quiz"><?php echo $quiz_string; ?></div>	
		<div class="article" id="article1"><?php echo $article1_string; ?></div>
		<div class="article" id="article2"><?php echo $article2_string; ?></div>
		<div class="une"><?php echo $une_string; ?></div>
	</div>
</div>

<!-- <input type="button" onClick="window.location.href='index.php'" value="Engendrer une nouvelle édition"> -->

</body>

</html>
