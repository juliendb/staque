<?php
	$errors = array();

	//fonction pour créer un array qui va récupérer l'id de user
	$id_question	= 0;
	$id_user 		= 0;
	$content		= "";

	if(empty($_GET['id_user']) && empty($_GET['id_question'])) {
		die('404');
	} else {

		$id_user 		= $_GET['id_user'];
		$id_question 	= $_GET['id_question'];
	}
	

	if (!empty($_POST)) {

		$content = $_POST['content'];

		if(strlen($content) < 2) {
			$errors[] = "Veuillez entrer une réponse à la question, merci.";
		}
	}

	if(empty($errors)){

		insertAnswer($id_question, $id_user, $content);
		
	}
		
	//print_r($content);
	//die();
	
?>
	
	<main class="container">

		<section class="answers">
			<form class="editAnswer" method="POST">
				<label for="content">Entrez votre réponse</label>
				<textarea name="content" id="content">
				</textarea>

				<input type="submit" id="valider" value="Valider" />

			</form>
		</section>
	</main>
