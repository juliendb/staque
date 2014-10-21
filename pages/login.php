<?php

	$errors = array();

	//mes variables
	$pseudoUser 	= "";
	$password		= "";

	/********* Vérification du formulaire de connection ***********/
 
	//est-ce que le form a été soumis
	if (!empty($_POST)){


		//récupère les données dans mes variables
		$pseudoUser 	= $_POST['pseudoUser'];
		$password 		= $_POST['password'];


		/*
		*	 début de la validation
		*/

		//vérifie si pseudo ou email est valide dans le champs
		if (emailIsExist($pseudoUser) || pseudoIsExist($pseudoUser)) 
		{ } else {
			$errors[] = "pseudo !";
		}

		//vérifie si le mot de passe est valise
		if (isValidPasswordInsc($password, $password)) 
		{
			$errors[] = "password !";
		}

		print_r($errors);

		if(empty($errors))
		{
		
			selectLogin($pseudoUser, $password);

		}
	}

?>





	<main class="container">
		<section class="formulaire">

			<div class="title-question">
				<h1>Connectez-vous à votre compte</h1>
			</div>

			<form id="inscrition" method="POST" novalidate>
				<div class="form-group">
					<label for="pseudoUser">Entrez votre pseudo</label>
					<input type="text" name="pseudoUser" id="pseudoUser" value="<?php echo $pseudoUser; ?>" />

					<?php if (!empty($errors['pseudoUser'])): ?>
					
					<?php endif; ?>
				</div>


				<div class="form-group">
					<label for="password">Entrez un mot de passe</label>
					<input type="password" name="password" id="password" value="" />

					<?php if (!empty($errors['password'])): ?>
					
					<?php endif; ?>
				</div>


				<div class="form-group">
					<div class="fake-label"></div>
					<input type="submit" id="valider" value="Valider" />
					
				</div>
			</form>	
		</section>
	</main>