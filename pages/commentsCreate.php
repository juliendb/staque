<?php
	$errors = array();

	//fonction pour créer un array qui va récupérer l'id de user
	$id_user 		= 0;
	$id_rubric 		= 0;
	$type_comment 	= "";
	$content		= "";

	if(empty($_GET['id_user']) && empty($_GET['id_rubric']) && empty($_GET['type_comment'])) {
		die('404');
	} else {

		$id_user 		= $_GET['id_user'];
		$id_rubric 		= $_GET['id_rubric'];
		$type_comment	= $_GET['type_comment'];
	}
	
	if (!empty($_POST)) {

		$content = $_POST['content'];

		if(strlen($content) < 2) {
			$errors[] = "Veuillez entrer un commentaire, merci.";
		}
	}

	if(empty($errors)){

		insertComment($id_rubric, $id_user, $type_comment, $content);
		
	}
		
	//print_r($content);
	//die();
	
?>
	
	<main class="container">

		<section id="comment">
			<form class="editComment" method="POST">
				<label for="content">Entrez votre commentaire</label>
				<textarea name="content" id="content">
				</textarea>

				<input type="submit" id="valider" value="Valider" />

				
				<?php if($type_comment === 'question') :?>

				<a href="<?php echo goQuestionLink($id_rubric); ?>" >Retours à la question</a>
				<?php endif; ?>
			</form>
		</section>
	</main>
