<?php
	
	// Changer les textes erreurs s'il te plait !

	// vérifie email
	function verifiedEmail($email)
	{
		$errors = array();


		if (empty($email)){
			$errors[] = "Entrez un email svp !";
		}
		elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$errors[] = "Votre email n'est pas valide !";
		}
		elseif (emailIsExist($email))
		{
			$errors[] = "Cet email existe déjà !";
		}


		return $errors;
	}

	// vérifie pseudo
	function isValidPseudo($pseudo)
	{
		$errors = array();

		if (empty($pseudo)){
			$errors[] = "Entrez un pseudo svp !";
		}
		elseif (pseudoIsExist($pseudo)){
			$errors[] = "Ce pseudo existe déjà !";
		}


		return $errors;
	}


	//vérifie name
	function isValidName($name)
	{
		$errors = array();

		if (strlen($name) < 2){
			$errors[] = "Votre mot de passe doit contenir 2 caractères minimum !";
		}
		elseif (strlen($name) > 100) {
			$errors[] = "Votre mot de passe est trop long !";
		}

		return $errors;
	}





	

	// vérifie email pour inscription
	function isValidPasswordInsc($password, $password_bis)
	{
		$errors = array();

		if (empty($password)){
			$errors[] = "Choisissez un mot de passe svp !";
		}
		elseif (empty($password_bis)){
			$errors[] = "Confirmez votre mot de passe, svp !";
		}
		elseif ($password_bis != $password){
			$errors[] = "Votre mot de passse ne correspond pas !";
		}
		elseif (strlen($password) < 7){
			$errors[] = "Votre mot de passe doit contenir 7 caractères minimum !";
		}


		return $errors;
	}
