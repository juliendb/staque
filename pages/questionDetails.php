<?php
	

	$id_question = 0;
	if (empty($_GET['id_question']))
	{
		goHome();
	
	} else {
		$id_question = $_GET['id_question'];

		$_SESSION['url'] = goQuestionLink($id_question);
	}



	$my_user = array();
	$connect = userIsLogged();

	// si session ouverte
	if ($connect) $my_user = $_SESSION["user"];


	


	$question = selectQuestion($id_question);

	$title = $question["title"];
	$content = $question["content"];

	$id_user = $question["id_user"];
	$link_adress = goUserLink($id_user);


	// vérifie la date question
	$dateCreated = $question["dateCreated"];
	$dateModified = $question["dateModified"];
	if (getBetweenDate($dateCreated, $dateModified) == "1 seconde(s)") {
		$date = "posée il y a ".getBetweenDate($dateCreated);
	} else {
		$date = "éditer il y a ".getBetweenDate($dateModified);
	}


?>

	<main class="container">

	<h1> Telle est la question</h1>

	<section id=" questionDetail">

		<div id="questionBloc">
			<div class="title-question">
				<a href="<?php echo goQuestionLink($id_question); ?>"><?php echo $title; ?></a>
			</div>

			<div class="content-question">
				<?php echo $content; ?>
			</div>
			


			<?php
				//boucle sur les tags
				$tags = selectTagsQuestion($id_question);
				foreach ($tags as $tag):
			?>

				<div class="tags_questions">
					<p><?php echo $tag["tag_name"]; ?></p>
				</div>

			<?php endforeach; ?>



			<div id="userDetail">
				<p><?php echo $date; ?></p>
				<div>
					<a href="<?php echo $link_adress; ?>">
						<img src="<?php echo $question["img_profile"]; ?>">
					</a>
					<a class="user" href="<?php echo $link_adress; ?>">
						<?php echo $question["user_pseudo"]; ?>
					</a>
					<p><?php echo $question["score"]; ?></p>
				</div>
			</div>

			<div id="editerQuestionDetails">
				<?php 
					//editer une question si la question est à utilisateur
					if ($connect && equalUser($my_user["id_user"], $question["id_user"])): 
					$link = goUpdateQuestionLink($question["id_question"]);
				?>
					<a class="editer" href="<?php echo $link; ?>">Editer ma question ?</a>
				<?php endif; ?>
			</div>
		

	

			


			<?php 

				// boucle de commentraires
				$comments = selectComments($id_question, "question");
				foreach($comments as $comment):

				$id_user = $comment["id_user"];
				$link_adress = goUserLink($id_user);


				// vérifie la date comment
				$dateCreated = $comment["dateCreated"];
				$dateModified = $comment["dateModified"];
				if (getBetweenDate($dateCreated, $dateModified) == "1 seconde(s)"){
					$date = "répondu il y a ".getBetweenDate($dateCreated);
				} else {
					$date = "éditer il y a ".getBetweenDate($dateModified);
				}

			?>
				<div id="comment">
					<p><?php echo $comment["content"]; ?></p>
					<div class="comment_profile">
						<a class="user" href="<?php echo $link_adress; ?>">
							<?php echo $comment["user_pseudo"]; ?>
						</a>
						<p><?php echo $date; ?></p>
					</div>
				</div>

			<?php endforeach; ?>


			<?php

				// lien vers creation commmentaire
				$link = "index.php?page=signup";
				if ($connect) $link = goCommentLink($id_question, "question");
			?>


			<a class="ajouter" href="<?php echo $link; ?>">ajouter un commentaire ?</a>

		</div>
	</section>

	<h1> Telles sont les réponses</h1>	
		
		<?php 

			//boucle sur les réponses
			$answers = selectAnswers($id_question);
			foreach($answers as $answer): 

			$id_user = $answer["id_user"];
			$link_adress = goUserLink($id_user);


			// vérifie la date answer
			$dateCreated = $answer["dateCreated"];
			$dateModified = $answer["dateModified"];
			if (getBetweenDate($dateCreated, $dateModified) == "1 seconde(s)"){
				$date = "répondu il y a ".getBetweenDate($dateCreated);
			} else {
				$date = "éditer il y a ".getBetweenDate($dateModified);
			}

		?>
			

			<section id="detailReponses">

				<div class="vote">
					
					<?php
						// affiche tous les éléments dans get
						$link = "id_answer=".$answer["id_answer"]."&id_userAnswer=".$id_user;
					?>

					<a class="plus" href="<?php echo "index.php?page=votes&".$link."&vote_type=1"; ?>">+</a>
					<p><?php echo calculVote($answer["id_answer"]); ?></p>
					<a class="moins" href="<?php echo "index.php?page=votes&".$link."&vote_type=0"; ?>">-</a>
				</div>

				<p><?php echo $answer["content"]; ?></p>
				
				<div class="profile_user">
					<p><?php echo $date; ?></p>

					<div>
						<a href="<?php echo $link_adress; ?>">
							<img src="<?php echo $answer["img_profile"]; ?>">
						</a>
						<a class="user" href="<?php echo $link_adress; ?>">
							<?php echo $answer["user_pseudo"]; ?>
						</a>
						<p><?php echo $answer["score"]; ?></p>
					</div>
				</div>




				<?php 
					//editer une réponse si la réponse est à utilisateur
					if ($connect && equalUser($my_user["id_user"], $answer["id_user"])): 
					$link = goUpdateAnswerLink($answer['id_answer']);
				?>
					<a class="ajouter" href="<?php echo $link; ?>">éditer ma réponse ?</a>
				<?php endif; ?>
				



				<?php 
					// boucle de commentraires
					$comments = selectComments($answer["id_answer"], "answer");
					foreach($comments as $comment):

					$id_user = $comment["id_user"];
					$link_adress = goUserLink($id_user);


					// vérifie la date comment
					$dateCreated = $comment["dateCreated"];
					$dateModified = $comment["dateModified"];
					if (getBetweenDate($dateCreated, $dateModified) == "1 seconde(s)"){
						$date = "répondu il y a ".getBetweenDate($dateCreated);
					} else {
						$date = "éditer il y a ".getBetweenDate($dateModified);
					}
				?>
					<div class="comment">
						<p><?php echo $comment["content"]; ?></p>

						<div class="comment_profile">
							<a class="linkUser" href="<?php echo $link_adress; ?>">
								<?php echo $comment["user_pseudo"]; ?>
							</a>
							<p class="date"><?php echo $date; ?></p>
						</div>
					</div>
				<?php endforeach; ?>



				<?php
					// lien vers creation commmentaire
					$link = "index.php?page=signup";
					if ($connect) $link = goCommentLink($answer["id_answer"], "answer"); 
				?>
				<a class="ajouter" href="<?php echo $link; ?>">ajouter un commentaire ?</a>



			</section>
		<?php endforeach; ?>


		<?php
			// lien vers creation réponse
			$link = "index.php?page=signup";
			if ($connect) $link = goAnswerLink($id_question);
		?>
		<a class="lien" href="<?php echo $link; ?>">ajouter une réponse ?</a>



	</main>