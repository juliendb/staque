<?php 
	

	// set user
	function SetUser($user_pseudo, $email, $password)
	{
		global $dbh;


		// sécurisation du mot de passe de l'utilisateur
		// appel de fonction hashage
		$salt = randomString();
		$hashedPassword = hashPassword($password, $salt);
		$token = randomString();


		$sql = "INSERT INTO users (userpseudo, email, status, password, salt, token, score, dateCreated, dateModified)
				VALUES (:userpseudo, :email, 1, :password, :salt, :token, 5, NOW(), NOW())";

			$stmt = $dbh->prepare($sql);
			$stmt->bindValue(':userpseudo', $user_pseudo);
			$stmt->bindValue(':email', $my_email);
			$stmt->bindValue(':password', $password);
			$stmt->bindValue(':salt', $salt);
			$stmt->bindValue(':token', $token);

			// si execute retourne à la page en question
			if ($stmt->execute())
			{
				goHome();
			}
	}



	// login de l'utilisateur
	function GetLogin($pseudo, $password)
	{
		global $dbh;

		//recherche l'utilisateur en bdd par son pseudo (ou email)
		$sql = "SELECT * FROM users
				WHERE pseudo = :login OR email = :login
				LIMIT 1";

		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(":login", $pseudo);
		$stmt->execute();

		$user = $stmt->fetch();

		// hash password 
		$hashedPassword = hashPassword($password, $user['salt']);
		if ($hashedPassword === $user['password'])
		{
			return true;


			// si truc alors bidule !
			$_SESSION['user'] = $user;
			goHome();
		}
	}





	//vérifie si les pseudo et emails existent dans la base de données


	//si pseudo existe
	function pseudoIsExist($pseudo)
	{
		global $dbh;

		$sql = "SELECT COUNT(*) FROM users 
				WHERE pseudo = :pseudo";

		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(":pseudo", $pseudo);
		$stmt->execute();

		// affiche
		$usernameFound = $stmt->fetchColumn();
		return $usernameFound;
	}


	//si email existe
	function emailIsExist($email)
	{
		global $dbh;

		$sql = "SELECT COUNT(*) FROM users 
				WHERE email = :email";
		
		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(":email", $email);
		$stmt->execute();
		
		//affiche
		$emailFound = $stmt->fetchColumn();
		return $emailFound;
	}









	
