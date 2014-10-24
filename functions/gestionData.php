<?php




	// SELECT, INSERT et UPDATE pour afficher les éléments dans les pages





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




	// select sur questions sans réponses
	function selectQuestionsHomeNo()
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
				GROUP BY Q.id_question
				HAVING COUNT(A.id_answer) = 0";


		$stmt = $dbh->prepare($sql);
		$stmt->execute();
		
		//affiche
		return $stmt->fetchAll();
	}







	// select sur questions sans réponses
	function selectQuestionsHomeTag($tag)
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
				LEFT JOIN answers AS A ON (Q.id_question = A.id_question)
				LEFT JOIN tags_relation AS R ON (R.id_question = Q.id_question)
				WHERE U.id_user = Q.id_user AND R.id_tag = :tag
				GROUP BY Q.id_question";


		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(":tag", $tag);
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
				AND Q.id_question = :id_question
				ORDER BY Q.dateModified DESC";

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
				ORDER BY A.dateCreated DESC
				LIMIT 6";

		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(":id_question", $id_question);
		$stmt->execute();
		
		//affiche
		return $stmt->fetchAll();
	}



	//selection le contenu seul s'une réponse
	function selectAnswer($id_answer)
	{
		global $dbh;


		$sql = "SELECT 	A.id_answer,
						A.id_question,
						A.id_user,
						A.content,
						A.dateCreated,
						A.dateModified

				FROM answers AS A
				WHERE A.id_answer = :id_answer";
				

		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(":id_answer", $id_answer);
		$stmt->execute();
		
		//affiche
		return $stmt->fetch();
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
				ORDER BY C.dateCreated DESC
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
	function insertQuestion($id_user, $title, $content, $id_tags)
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
			$lastID = $dbh->lastInsertId();
			$link = goQuestionLink($lastID);

			foreach ($id_tags as $key) 
			{
				insertTagsQuestion($lastID, $key["id_tag"]);
			}


			// update vote
			selectVote($id_answer, 2);
			header("Location: $link");
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

			// update vote
			selectVote($id_answer, 4);

			$link = goQuestionLink($id_question);
			header("Location: $link");
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
			// redirige vers page question
			$redirection = $_SESSION['url'];
			header("Location: $redirection");
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
			$redirection = $_SESSION['url'];
			header("Location: $redirection");
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
			$redirection = $_SESSION['url'];
			header("Location: $redirection");
		}
	}







	// il existe pas et on s'en fout totalement de ce truc bidule !



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












	// update score user
	function updateScore($id_user, $score)
	{
		global $dbh;


		$sql = "UPDATE users
				SET score += :score
				WHERE id_user = :id_user";


		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(":id_user", $id_user);
		$stmt->bindValue(":score", $score);
		$stmt->execute();
	}




	// select si vote déja réponse ou empeche de vote pour sa réponse
	function selectVote($id_user, $id_answer)
	{
		global $dbh;


		$sql = "SELECT id_vote
				FROM votes
				WHERE id_user = :id_user
				AND id_answer = :id_answer";

		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(":id_user", $id_user);
		$stmt->bindValue(":id_answer", $id_answer);
		$stmt->execute();
		
		return $stmt->fetchColumn();
	}






	// select vote
	function selectCalculVote($id_answer, $vote_type)
	{
		global $dbh;


		$sql = "SELECT COUNT(*)
				FROM votes
				WHERE id_answer = :id_answer
				AND vote_type = :vote_type";

		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(":id_answer", $id_answer);
		$stmt->bindValue(":vote_type", $vote_type);
		$stmt->execute();
		
		return $stmt->fetchColumn();
	}



	// insert vote
	function insertVote($id_user, $id_answer, $vote_type, $id_userAnswer)
	{

		global $dbh;


		$sql = "INSERT INTO votes (id_user, id_answer, vote_type)
				VALUES (:id_user, :id_answer, :vote_type)";

		$stmt = $dbh->prepare($sql);
		$stmt->bindValue(':id_user', $id_user);
		$stmt->bindValue(':id_answer', $id_answer);
		$stmt->bindValue(':vote_type', $vote_type);

		// si execute retourne à la page en question
		if ($stmt->execute())
		{	
			
			// vote défavorable
			if ($vote_type == 0) {
				updateScore($id_user, -1);
				updateScore($id_userAnswer, -5);
			}

			// vote favorable
			if ($vote_type == 1) {
				updateScore($id_user, 1);
				updateScore($id_userAnswer, 5);
			}

			// redirige vers page question
			$redirection = $_SESSION['url'];
			header("Location: $redirection");
		}
	}
	
