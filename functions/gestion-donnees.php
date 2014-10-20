<?php 
	

	// inscriptions users
	function insertUser($user_pseudo, $email, $password, $redirection)
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
			//$redirection
			goHome();
		}
	}








	// login de l'utilisateur
	function selectLogin($pseudo, $password)
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










	// SELECT, INSERT et UPDATE pour afficher les éléments dans les pages







	// on affiche avec select


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









	// select question home

	//print_r(selectQuestionsHome());
	function selectQuestionsHome()
	{
		global $dbh;


		$sql = "SELECT 	Q.id_question,
						Q.title,
						Q.dateCreated,
						Q.dateModified,

						U.id_user,
						U.user_pseudo,
						U.score,

						COUNT(A.id_answer) AS TotalReponses 
						/*COUNT(V.id_vote) AS TotalVotes */
			

				FROM users AS U, questions AS Q	
				LEFT OUTER JOIN answers AS A ON (Q.id_question = A.id_question)
				/* LEFT OUTER JOIN votes AS V ON (A.id_answer = V.id_answer) */
				WHERE U.id_user = Q.id_user
				GROUP BY Q.id_question";


		$stmt = $dbh->prepare($sql);
		$stmt->execute();
		
		//affiche
		return $stmt->fetchAll();
	}








	// select tags question

	//echo "<pre>";print_r(selectTagsQuestion(1));echo "</pre>";
	function selectTagsQuestion($id_question)
	{
		global $dbh;


		$sql = "SELECT 	T.id_tag,
						T.tag_name

				FROM tags AS T
				LEFT OUTER JOIN tags_relation AS R ON (R.id_tag = T.id_tag)
				WHERE R.id_question = :id_question";


		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(":id_question", $id_question);
		$stmt->execute();
		
		//affiche
		return $stmt->fetchAll();
	}










	// creation tags question

	//echo "<pre>";print_r(insertTagsQuestion(1, 2));echo "</pre>";
	function insertTagsQuestion($id_question, $id_tag)
	{
		global $dbh;


		$sql = "INSERT INTO tags_relation (id_question, id_tag)
				VALUES (:id_question, :id_tag)";


		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(":id_question", $id_question);
		$stmt->bindValue(":id_tag", $id_tag);
		$stmt->execute();
	}




	// creation tag

	//insertNewTag("JQuery");
	function insertNewTag($tag_name)
	{
		global $dbh;


		$sql = "INSERT INTO tags (tag_name)
				VALUES (:tag_name)";


		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(":tag_name", $tag_name);
		$stmt->execute();

		return $dbh->lastInsertId();
	}


	// affiche id_tag pour créer dans la table et si en plus on mets un petit if et fonction c'est cool !
	//if (selectIDTag("JQuery")) $lala = selectIDTag("JQuery");
	//insertTagsQuestion(1, $lala["id_tag"]);
	function selectIDTag($tag_name)
	{
		global $dbh;


		$sql = "SELECT id_tag, tag_name
				FROM tags
				WHERE tag_name = :tag_name";


		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(":tag_name", $tag_name);
		$stmt->execute();
		
		//affiche
		return $stmt->fetch();
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

						COUNT(DISTINCT(Q.id_question)) AS TotalQuestions,
						COUNT(DISTINCT(A.id_answer)) AS TotalAnswers


				FROM users AS U, questions AS Q, answers AS A
				WHERE Q.id_user = U.id_user AND A.id_user = U.id_user
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


				FROM users AS U, questions AS Q, answers AS A
				WHERE Q.id_user = :id_user AND A.id_user = :id_user";


		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(":id_user", $id_user);
		$stmt->execute();
		
		//affiche
		return $stmt->fetchAll();
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
		$stmt->execute();
		
		// si execute retourne à la page en question
		if ($stmt->execute())
		{
			// on verra ce que l'on affiche
			//goHome();
		}
	}






















	// select question detail, reponses, commentaires...


	// select question detail

	//print_r(selectQuestion(1));
	function selectQuestion($id_question)
	{
		global $dbh;


		$sql = "SELECT 	Q.id_question,
						Q.title,
						Q.content,
						Q.dateCreated,
						Q.dateModified,

						U.id_user,
						U.user_pseudo,
						U.img_profile,
						U.score

				FROM users U, questions Q				
				WHERE U.id_user = Q.id_user
				AND Q.id_question = :id_question";

		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(":id_question", $id_question);
		$stmt->execute();
		
		//affiche
		return $stmt->fetch();
	}





	// select réponses en fonction de id_question

	//echo "<pre>"; print_r(selectAnswers(1)); echo "</pre></br>";
	function selectAnswers($id_question)
	{
		global $dbh;


		$sql = "SELECT 	A.id_answer,
						A.content,
						A.vote,
						A.dateCreated,
						A.dateModified,

						U.id_user,
						U.user_pseudo,
						U.img_profile,
						U.score
	

				FROM users AS U, answers AS A
				WHERE U.id_user = A.id_user
				AND A.id_question = :id_question
				LIMIT 6";

		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(":id_question", $id_question);
		$stmt->execute();
		
		//affiche
		return $stmt->fetchAll();
	}





	// select commentaires en fonction de id_question ou id_reponse

	//print_r(selectComments(1, "questions"));
	function selectComments($id_rubric, $type_comment)
	{
		global $dbh;


		$sql = "SELECT 	C.id_comment,
						C.type_comment,
						C.content,
						C.dateCreated,
						C.dateModified,

						U.id_user,
						U.user_pseudo,
						U.score

				FROM users AS U, comments AS C				
				WHERE U.id_user = C.id_user
				AND C.id_rubric = :id_rubric
				AND C.type_comment = :type_comment
				LIMIT 3";

		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(":id_rubric", $id_rubric);
		$stmt->bindValue(":type_comment", $type_comment);
		$stmt->execute();
		
		//affiche
		return $stmt->fetchAll();
	}












	// creation question detail, reponses, commentaires...


	// création question detail

	//insertQuestion(1, "css", "je suis là");
	function insertQuestion($id_user, $title, $content)
	{
		global $dbh;


		$sql = "INSERT INTO questions (id_user, title, content, dateCreated, dateModified)
				VALUES (:id_user, :title, :content, NOW(), NOW())";

		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(':id_user', $id_user);
		$stmt->bindValue(':title', $title);
		$stmt->bindValue(':content', $content);

		// si execute retourne à la page en question
		if ($stmt->execute())
		{
			// on verra ce que l'on affiche
			//goHome();
		}
	}





	// création réponse en fonction de id_question

	//insertAnswer(1, 1, "je suis du texte et je l'assume !"));
	function insertAnswer($id_question, $id_user, $content)
	{
		global $dbh;


		$sql = "INSERT INTO answers (id_question, id_user, content, dateCreated, dateModified)
				VALUES (:id_question, :id_user, :content, NOW(), NOW())";

		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(':id_question', $id_question);
		$stmt->bindValue(':id_user', $id_user);
		$stmt->bindValue(':content', $content);

		// si execute retourne à la page en question
		if ($stmt->execute())
		{
			// on verra ce que l'on affiche
			//goHome();
		}
	}





	// création commentaire en fonction de id_question ou id_reponse

	//insertComment(1, 1, "je suis du texte et je l'assume !"));
	function insertComment($id_rubric, $id_user, $type_comment, $content)
	{
		global $dbh;


		$sql = "INSERT INTO comments (id_rubric, id_user, type_comment, content, dateCreated, dateModified)
				VALUES (:id_rubric, :id_user, :type_comment, :content, NOW(), NOW())";

		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(':id_rubric', $id_rubric);
		$stmt->bindValue(':id_user', $id_user);
		$stmt->bindValue(':type_comment', $type_comment);
		$stmt->bindValue(':content', $content);

		// si execute retourne à la page en question
		if ($stmt->execute())
		{
			// on verra ce que l'on affiche
			//goHome();
		}
	}















	// modifie question detail, reponses, commentaires...


	// modifie question detail

	//updateQuestion(1, "css", "je suis là");
	function updateQuestion($id_question, $id_user, $title, $content)
	{
		global $dbh;


		$sql = "UPDATE questions
				SET title = :title,
					content = :content,
					dateModified = NOW() 

				WHERE id_question = :id_question 
				AND id_user = :id_user";


		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(':id_question', $id_question);
		$stmt->bindValue(':id_user', $id_user);
		$stmt->bindValue(':title', $title);
		$stmt->bindValue(':content', $content);

		// si execute retourne à la page en question
		if ($stmt->execute())
		{
			// on verra ce que l'on affiche
			//goHome();
		}
	}





	// modifie réponse en fonction de id_question

	//updateAnswer(1, 1, "je suis du texte et je l'assume !"));
	function updateAnswer($id_question, $id_answer, $id_user, $content)
	{
		global $dbh;


		$sql = "UPDATE answers
				SET content = :content,
					dateModified = NOW() 

				WHERE id_question = :id_question
				AND id_answer = :id_answer
				AND id_user = :id_user";


		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(':id_question', $id_question);
		$stmt->bindValue(':id_answer', $id_answer);
		$stmt->bindValue(':id_user', $id_user);
		$stmt->bindValue(':content', $content);

		// si execute retourne à la page en question
		if ($stmt->execute())
		{
			// on verra ce que l'on affiche
			//goHome();
		}
	}





	// modifie commentaire en fonction de id_question ou id_reponse

	//updateComment(1, 1, "je suis du texte et je l'assume !"));
	function updateComment($id_comment, $content)
	{
		global $dbh;


		$sql = "UPDATE comments
				SET content = :content,
					dateModified = NOW()

				WHERE id_comment = :id_comment";


		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(':id_comment', $id_comment);
		$stmt->bindValue(':content', $content);

		// si execute retourne à la page en question
		if ($stmt->execute())
		{
			// on verra ce que l'on affiche
			//goHome();
		}
	}
	
