<?php

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
	
?>

<!DOCTYPE html>
<html lang="fr">

<head>
	<?php include("header.php"); ?>
</head>

<body>

	<div id="main-wrapper">

		<div class="project-wrapper" style="background-image:url('./photos/<?php echo $couv_string; ?>'); ">
		
			<h1><span class="big_h1">Michel Drucker</span>e-magazine</h1>

			<div class="quiz"><?php echo $quiz_string; ?></div>			
			<div class="article" id="article1"><?php echo $article1_string; ?></div>
			<div class="article" id="article2"><?php echo $article2_string; ?></div>
			<div class="une"><?php echo $une_string; ?></div>
			
		</div>

	</div>
	
	<input type="button" onClick="window.location.reload()" value="Engendrer une nouvelle édition">

</body>

</html>