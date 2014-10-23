<?php

	$errors = array();

	//mes variables
	$pseudoUser 	= "";
	$emailUser		= "";
	$password		= "";
	$passwordBis	= "";


	/********* Vérification du formulaire d'inscription ***********/
 
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
		

		print_r($errors);


		//si le form est valide, envoit le message
		if(empty($errors)){
		
			insertUser($pseudoUser, $emailUser, $password);

			//include("mail.php");
		}
	} 

?>





	<main class="container">
		<h1>PAS ENCORE INSCRIT ?  CRÉEZ UN COMPTE !</h1>

		<section class="formulaire">
			<form id="inscrition" method="POST" novalidate>
				<div class="form-group">
					<input type="text" name="pseudoUser" id="pseudoUser" placeholder="Votre pseudo" value="<?php echo $pseudoUser; ?>" />

					<?php if (!empty($errors['pseudoUser'])): ?>
					
					<?php endif; ?>
				</div>

				<div class="form-group">
					<input type="text" name="emailUser" id="emailUser" placeholder="Votre email" value="<?php echo $emailUser; ?>" />

					<?php if (!empty($errors['emailUser'])): ?>
				
					<?php endif; ?>
				</div>

				<div class="form-group">
					<input type="password" name="password" id="password" placeholder="Votre mot de passe" value="<?php echo $password; ?>" />

					<?php if (!empty($errors['password'])): ?>
					
					<?php endif; ?>
				</div>

				<div class="form-group">
					<input type="password" name="passwordBis" id="passwordBis" placeholder="Vérifier votre mot de passe" value="<?php echo $passwordBis; ?>" />

					<?php if (!empty($errors['passwordBis'])): ?>
					
					<?php endif; ?>
				</div>

				<div class="form-group">
					<input type="submit" id="valider" value="Valider" />	
				</div>
			</form>	
		</section>
	</main>
