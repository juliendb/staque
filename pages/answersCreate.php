<?php
	$errors = array();

	//fonction pour créer un array qui va récupérer l'id de user
	$id_question	= 0;
	$id_user 		= 0;
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
	}
	

	if (!empty($_POST)) {

		$content = $_POST['content'];

		if(strlen($content) < 2) {
			$errors[] = "Veuillez entrer une réponse à la question, merci.";
		}
	

		if(empty($errors)){

			insertAnswer($id_question, $id_user, $content);
			
		}
	}
	
?>
	
	<main class="container">

		<section class="answers">
			<form class="editAnswer" method="POST">
				
				<div class="form-group">
					<textarea name="content" id="contentEdit" rows="10" cols="40">
						<?php echo $content; ?>
					</textarea>
				</div>

				<div class="form-group">
					<input type="submit" id="valider" value="Valider" />
				</div>

			</form>
		</section>
	</main>
