<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8" />
</head>

<body>

<form action="test.php" method="get">

	<?php
	include("class.googlesheet.php");
	include("class.sentence.php");	
	include("class.word.php");
	if (isset($_GET['une_id'])) {
		$une_min = $une_max = addslashes($_GET['une_id']);
	}
	else {
		$couv_min = 5;
		$couv_max = 29;
		$une_min = 5;
		$une_max = 17;
		$article_min = 5;
		$article_max = 47;
		$quiz_min = 5;
		$quiz_max = 28;
	}
	// CREATION DE LA TABLE D'INDEX ET DU CACHE S'IL N'EXISTE PAS
	$gsheet = new GoogleSheet("https://docs.google.com/spreadsheets/d/1-8VrVG5YeTYLUXb-Y9v2cHdtTApO8qLu4PDtOkKquww/edit#gid=0");
	$gid_table = $gsheet->getGidTable();
	if (isset($_GET['refresh'])) { // Pour forcer le rafraîchissement du cache
		$gsheet->BuildAllCache();
	}
	
	/* CREATION COUV  */
	$couv_obj = new Sentence($gid_table,"couv",$couv_min,$couv_max);
	$couv_id = $couv_obj->getSentenceId();
	$couv_string = $couv_obj->getSentenceString();
	?>
		<h2>COUV de type ligne #<input type="number" name="couv_id" value ="<?php echo $couv_id ?>"/> :</h2>
		<p><?php echo $couv_string; ?><p/>
		<hr/>
	<?php
	
	/* CREATION DE LA UNE  */
	$une_obj = new Sentence($gid_table,"une",$une_min,$une_max);
	$une_id = $une_obj->getSentenceId();
	$une_string = $une_obj->getSentenceString();
	?>
		<h2>UNE de type ligne #<input type="number" name="une_id" value ="<?php echo $une_id ?>"/> :</h2>
		<?php echo $une_string; ?>
		<hr/>
	<?php

	/* CREATION DE L'ARTICLE 1  */
	$article1_obj = new Sentence($gid_table,"titre-article",$article1_min,$article1_max);
	$article1_id = $article1_obj->getSentenceId();
	$article1_string = $article1_obj->getSentenceString();
	?>
		<h2>ARTICLE 1 de type ligne #<input type="number" name="article1_id" value ="<?php echo $article1_id ?>"/> :</h2>
		<?php echo $article1_string; ?>
		<hr/>

	<?php

	/* CREATION DE L'ARTICLE 2  */
	$article2_obj = new Sentence($gid_table,"titre-article",$article_min,$article_max);
	$article2_id = $article2_obj->getSentenceId();
	$article2_string = $article2_obj->getSentenceString();
	?>
		<h2>ARTICLE 2 de type ligne #<input type="number" name="article2_id" value ="<?php echo $article2_id ?>"/> :</h2>
		<?php echo $article2_string; ?>
		<hr/>
		
	<?php

	/* CREATION DU QUIZ  */
	$quiz_obj = new Sentence($gid_table,"titre-quiz",$quiz_min,$quiz_max);
	$quiz_id = $quiz_obj->getSentenceId();
	$quiz_string = $quiz_obj->getSentenceString();
	?>
		<h2>QUIZ de type ligne #<input type="number" name="quiz_id" value ="<?php echo $quiz_id ?>"/> :</h2>
		<?php echo $quiz_string; ?>
		<hr/>


	<!-- <input type="submit" value="re-tester avec cette ligne"> -->

</form>  

<form action="test.php" method="get">
	<input type="submit" value="re-tester au hasard">
</form>

</body>

</html>