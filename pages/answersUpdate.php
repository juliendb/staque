<?php

	$errors = array();

	//fonction pour créer un array qui va récupérer l'id de user
	$id_user 		= 0;
	$id_question	= 0;
	$id_answer		= 0;
	$content		= "";



	$my_user = array();
	$connect = userIsLogged();

	// si session ouverte
	if ($connect) $my_user = $_SESSION["user"];




	if(empty($_GET['id_answer']) || !$connect) {
		goHome();
	} else {

		$id_user 		= $my_user['id_user'];
		$id_answer 		= $_GET['id_answer'];



		// va récupérer les données dans la table sql
		$answer = selectAnswer($id_answer);
		$content = $answer['content'];
		$id_question = $answer['id_question'];


	}
	
	if (!empty($_POST)) {

		$content = $_POST['content'];

		if(strlen($content) < 2) {
			$errors[] = "Veuillez entrer un contenu pour la réponse, merci.";
		}

		if(empty($errors)) {

			updateAnswer($id_question, $id_answer, $id_user, $content);
		}
	}
	
?>

	<main class="container">
		<form id="answer" method="POST" novalidate>

			<div class="form-group">
				<textarea name="content" id="contentEdit" rows="10" cols="40">
					<?php echo $content; ?>
				</textarea>
			</div>

			<div class="form-group">
				<input type="submit" id="valider" value="Valider" />
			</div>

		</form>
	</main>