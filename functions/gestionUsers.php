<?php



	// select insert update pour Users


	

	// inscriptions users
	function insertUser($user_pseudo, $email, $password)
	{
		global $dbh;



		// sécurisation du mot de passe de l'utilisateur
		// appel de fonction hashage
		$salt = randomString();
		$hashedPassword = hashPassword($password, $salt);
		$token = randomString();


		$sql = "INSERT INTO users (img_profile, user_pseudo, email, status, password, salt, token, score, dateCreated, dateModified)
				VALUES ('uploads/thumbs/default.jpg', :user_pseudo, :email, 1, :password, :salt, :token, 5, NOW(), NOW())";

		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(':user_pseudo', $user_pseudo);
		$stmt->bindValue(':email', $email);
		$stmt->bindValue(':password', $hashedPassword);
		$stmt->bindValue(':salt', $salt);
		$stmt->bindValue(':token', $token);

		// si execute retourne à la page en question
		if ($stmt->execute())
		{
			selectLogin($user_pseudo, $password);
			goHome();
		}
	}





	function updateStatus($id_user, $status)
	{
		if ($status == "connected") $status = 1;
		if ($status == "deconnected") $status = 0;


		global $dbh;

		$sql = "UPDATE users
				SET status = :status
				WHERE id_user = :id_user";


		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(":id_user", $id_user);
		$stmt->bindValue(":status", $status);
		$stmt->execute();
	}









	// select user home

	//echo "<pre>";print_r(selectUsersHome());echo "</pre>";
	function selectUsersHome()
	{
		global $dbh;


		$sql = "SELECT 	U.id_user,
						U.user_pseudo,
						U.img_profile,
						U.country,
						U.score,
						U.dateCreated,
						U.dateModified,

						COUNT(DISTINCT(Q.id_question)) AS TotalQuestions,
						COUNT(DISTINCT(A.id_answer)) AS TotalAnswers


				FROM users AS U
				LEFT JOIN questions AS Q ON Q.id_user = U.id_user
				LEFT JOIN answers AS A ON A.id_user = U.id_user
				GROUP BY U.id_user";

		$stmt = $dbh->prepare($sql);
		$stmt->execute();
		
		//affiche
		return $stmt->fetchAll();
	}














	// select user detail

	//echo "<pre>";print_r(selectUserDetail(1));echo "</pre>";
	function selectUserDetail($id_user)
	{
		global $dbh;


		$sql = "SELECT 	U.user_pseudo,
						U.user_name,
						U.email,
						U.status,
						U.language,
						U.job,
						U.country,
						U.score,
						U.img_profile,
						U.dateCreated,
						U.dateModified,

						COUNT(DISTINCT(Q.id_question)) AS TotalQuestions,
						COUNT(DISTINCT(A.id_answer)) AS TotalAnswers


				FROM users AS U
				LEFT JOIN questions AS Q ON Q.id_user = U.id_user
				LEFT JOIN answers AS A ON A.id_user = U.id_user
				WHERE U.id_user = :id_user";


		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(":id_user", $id_user);
		$stmt->execute();
		
		//affiche
		return $stmt->fetch();
	}







	// modifie user detail

	//echo "<pre>";print_r(updateUserDetail(1));echo "</pre>";
	function updateUserDetail($id_user, $user_name, $email, $language, $job, $country, $img_profile)
	{
		global $dbh;

		$sql = "UPDATE users
				SET user_name = :user_name,
					email = :email,
					language = :language,
					job = :job,
					country = :country,
					img_profile = :img_profile,
					dateModified = NOW()

				WHERE id_user = :id_user";


		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(":id_user", $id_user);

		// liste de tous les éléments à modifier
		$stmt->bindValue(":user_name", $user_name);
		$stmt->bindValue(":email", $email);
		$stmt->bindValue(":language", $language);
		$stmt->bindValue(":job", $job);
		$stmt->bindValue(":country", $country);
		$stmt->bindValue(":img_profile", $img_profile);
		

		// si execute retourne à la page en question
		if ($stmt->execute())
		{
			$link = goUserLink($id_user);
			header("Location: $link");
		}
	}








	function selectTotalMembers()
	{
		$list = array();
		global $dbh;


		// membres total
		$sql = "SELECT COUNT(*)
				FROM users";

		$stmt = $dbh->prepare($sql);
		$stmt->execute();
		$list[] = $stmt->fetchColumn();


		// membres connecte
		$sql = "SELECT COUNT(*)
				FROM users
				WHERE status = 1";

		$stmt = $dbh->prepare($sql);
		$stmt->execute();
		$list[] = $stmt->fetchColumn();
		
		
		return $list;
	}









	//select link user en fonction de id user
	function selectLinkUser($id_user)
	{
		global $dbh;


		$sql = "SELECT id_link, link
				FROM links
				WHERE id_user = :id_user";


		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(":id_user", $id_user);
		$stmt->execute();
		
		//affiche
		return $stmt->fetchAll();
	}



	//insert link user en fonction de id user
	function insertLinkUser($id_user, $link)
	{
		global $dbh;


		$sql = "INSERT INTO links (id_user, link)
				VALUES (:id_user = :link)";


		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(":id_user", $id_user);
		$stmt->bindValue(":link", $link);
		$stmt->execute();
	}



	//update link user en fonction de id link
	function updateLinkUser($id_link, $link)
	{
		global $dbh;


		$sql = "UPDATE links
				SET link = :link
				WHERE id_link = :id_link";


		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(":id_link", $id_link);
		$stmt->bindValue(":link", $link);
		$stmt->execute();
	}










	// login de l'utilisateur
	function selectLogin($user_pseudo, $password)
	{
		global $dbh;

		//recherche l'utilisateur en bdd par son pseudo (ou email)
		$sql = "SELECT * FROM users
				WHERE user_pseudo = :login OR email = :login
				LIMIT 1";

		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(":login", $user_pseudo);
		$stmt->execute();

		$user = $stmt->fetch();

		// hash password 
		$hashedPassword = hashPassword($password, $user['salt']);
		if ($hashedPassword === $user['password'])
		{
			
			// si truc alors bidule !
			updateStatus($user["id_user"], "connected");
			$_SESSION['user'] = $user;

			
			if (!empty($_SESSION['url']))
			{
				$redirection = $_SESSION['url'];
				header("Location: $redirection");
			}

		}
	}









	//vérifie si les pseudo et emails existent dans la base de données


	//si pseudo existe
	function pseudoIsExist($user_pseudo)
	{
		global $dbh;

		$sql = "SELECT COUNT(*) FROM users 
				WHERE user_pseudo = :user_pseudo";

		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(":user_pseudo", $user_pseudo);
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