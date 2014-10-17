<?php
	
	// Changer les textes erreurs s'il te plait !

	// vérifie email
	function verifiedEmail($email)
	{
		$errors = array();


		if (empty($email)){
			$errors[] = "Please provide an email !";
		}
		elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$errors[] = "Your email is not valid !";
		}
		elseif (emailIsExist($email))
		{
			$errors[] = "This email already exists !";
		}


		return $errors;
	}

	// vérifie pseudo
	function isValidPseudo($pseudo)
	{
		$errors = array();

		if (empty($pseudo)){
			$errors[] = "Please provide an username !";
		}
		elseif (pseudoIsExist($pseudo)){
			$errors[] = "This username already exists !";
		}


		return $errors;
	}





	// cette fonction là je te là laisse la fonction hein gaele !

	// vérifie email pour inscription
	function isValidPasswordInsc()
	{
		$errors = array();

		if (empty($password)){
			$errors[] = "Please choose a password !";
		}
		elseif (empty($password_bis)){
			$errors[] = "Please confirm your password !";
		}
		elseif ($password_bis != $password){
			$errors[] = "Your passwords do not match !";
		}
		elseif (strlen($password) < 7){
			$errors[] = "Your password should have at least 7 characters !";
		}


		return $errors;
	}
