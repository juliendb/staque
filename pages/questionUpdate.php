<?php

	$errors = array();
	$question = array();

	//fonction pour créer un array qui va récupérer l'id de user
	$id_user 		= 0;
	$id_question	= 0;
	$title 			= "";
	$content		= "";




	$my_user = array();
	$connect = userIsLogged();

	// si session ouverte
	if ($connect) $my_user = $_SESSION["user"];



	if(empty($_GET['id_question']) || !$connect) {
		goHome();
	} else {

		$id_user 		= $my_user['id_user'];
		$id_question 	= $_GET['id_question'];

		// va récupérer les données dans la table sql
		$question = selectQuestion($id_question);


		$title 			= $question['title'];
		$content		= $question['content'];

	}
	
	if (!empty($_POST)) {

		$content = $_POST['content'];
		$title 	= $_POST['title'];

		if(strlen($content) < 2) {
			$errors[] = "Veuillez entrer un contenu pour la question, merci.";
		}

		if(empty($errors)) {

			updateQuestion($id_question, $id_user, $title, $content);
		}
	}
		
?>

	<main class="container">

		<form id="titleQuestion" method="POST" novalidate>

			<label for="title">Modifier le titre question</label>
			<input name="title" value="<?php echo $title; ?>">
			

			<div class="form-group">
				<label for="content">Modifier la question</label>
				<textarea name="content" id="contentEdit" rows="10" cols="40">
					<?php echo $content; ?>
				</textarea>
			</div>

			<div class="form-group">
				<input type="submit" name="valider">
			</div>

		</form>
	</main>