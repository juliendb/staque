<?php

	$errors = array();

	//mes variables
	$pseudoUser 	= "";
	$emailUser		= "";
	$password		= "";
	$passwordBis	= "";


	/********* Vérification du sondage et envoie ***********/
 
	//est-ce que le form a été soumis
	if (!empty($_POST)){


		//récupère les données dans mes variables
		$pseudoUser 	= $_POST['pseudoUser'];
		$emailUser 		= $_POST['emailUser'];
		$password 		= $_POST['password'];
		$passwordBis 	= $_POST['passwordBis']; 


		/*
		*	 début de la validation
		*/

		//pseudoUser est valide et si il n'existe pas
		if ( isValidPseudo($pseudoUser) ) {
			$errors[] = isValidPseudo($pseudoUser);
		}
	

		//email est est valide et si il n'existe pas
		if (  verifiedEmail($emailUser) ) {
			$errors[] = verifiedEmail($emailUser);
		}

		//password est valide et si il n'existe pas

		if ( isValidPasswordInsc($password ,$passwordBis) ) {
			$errors[] =  isValidPasswordInsc($password , $passwordBis);
		}

	


		//si le form est valide, envoit le message
		if(empty($errors)){

			insertUser($pseudoUser, $emailUser, $password, $passwordBis);

			//include("mail.php");
		}
	} 

?>





	<main class="container">
		<section class="formulaire">

			<div class="title-question">
				<h1>PAS ENCORE INSCRIT ?  CRÉEZ UN COMPTE !</h1>
			</div>

			<form id="inscrition" method="POST" novalidate>
				<div class="form-group">
					<label for="pseudoUser">Entrez votre pseudo</label>
					<input type="text" name="pseudoUser" id="pseudoUser" value="<?php echo $pseudoUser; ?>" />

					<?php if (!empty($errors['pseudoUser'])): ?>
					
					<?php endif; ?>
				</div>

				<div class="form-group">
					<label for="emailUser">Entrez votre email</label>
					<input type="text" name="emailUser" id="emailUser" value="<?php echo $emailUser; ?>" />

					<?php if (!empty($errors['emailUser'])): ?>
				
					<?php endif; ?>
				</div>

				<div class="form-group">
					<label for="password">Entrez un mot de passe</label>
					<input type="password" name="password" id="password" value="<?php echo $password; ?>" />

					<?php if (!empty($errors['password'])): ?>
					
					<?php endif; ?>
				</div>

				<div class="form-group">
					<label for="passwordBis">Vérifiez votre mot de passe</label>
					<input type="password" name="passwordBis" id="passwordBis" value="<?php echo $passwordBis; ?>" />

					<?php if (!empty($errors['passwordBis'])): ?>
					
					<?php endif; ?>
				</div>

				<div class="form-group">
					<div class="fake-label"></div>
					<input type="submit" id="valider" value="Valider" />
					
				</div>
			</form>	
		</section>
	</main>
