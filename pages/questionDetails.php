<?php
	
	$id_question = 0;
	if (empty($_GET['id_question']))
	{
		goHome();
	
	} else {
		$id_question = $_GET['id_question'];
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
	if (getBetweenDate($dateCreated, $dateModified) == "match") {
		$date = "posée il y a ".getBetweenDate($dateCreated, "NOW");
	} else {
		$date = "éditer il y a ".getBetweenDate($dateModified, "NOW");
	}


?>

	<main class="container">
		<section class="detail-question">

			<div class="title-question">
				<a href="<?php echo goQuestionLink($id_question); ?>">
					<?php echo $title; ?>
				</a>
			</div>

			<div class="content-question">
				<p>
					<?php echo $content; ?>
				</p>
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





			<div class="profile_user">
				<p><?php echo $date; ?></p>
				<div>
					<a href="<?php echo $link_adress; ?>">
						<img src="<?php echo $question["img_profile"]; ?>">
					</a>
					<a href="<?php echo $link_adress; ?>">
						<?php echo $question["user_pseudo"]; ?>
					</a>
					<p><?php echo $question["score"]; ?></p>
				</div>
			</div>





			<?php 
				//editer une question si la question est à utilisateur
				if ($connect && equalUser($my_user["id_user"], $question["id_user"])): 
				$link = goUpdateQuestionLink($my_user["id_user"], $question["id_question"]);
			?>
				<a href="<?php echo $link; ?>">éditer ma question ?</a>
			<?php endif; ?>


			


			<?php 
				// boucle de commentraires
				$comments = selectComments($id_question, "question");
				foreach($comments as $comment):

				$id_user = $comment["id_user"];
				$link_adress = goUserLink($id_user);


				// vérifie la date comment
				$dateCreated = $comment["dateCreated"];
				$dateModified = $comment["dateModified"];
				if (getBetweenDate($dateCreated, $dateModified) == "match"){
					$date = "répondu il y a ".getBetweenDate($dateCreated, "NOW");
				} else {
					$date = "éditer il y a ".getBetweenDate($dateModified, "NOW");
				}

			?>
				<div class="comment">
					<p><?php echo $comment["content"]; ?></p>
					<div class="comment_profile">
						<a href="<?php echo $link_adress; ?>">
							<?php echo $comment["user_pseudo"]; ?>
						</a>
						<p><?php echo $date; ?></p>
					</div>
				</div>

			<?php endforeach; ?>


			<?php
				// lien vers creation commmentaire
				$link = "index.php?page=signup";
				if ($connect) $link = goCommentLink($my_user["id_user"], $id_question, "question");
			?>
			<a href="<?php echo $link; ?>">ajouter un commentaire ?</a>


		</section>


		
		<?php 
			//boucle sur les réponses
			$answers = selectAnswers($id_question);
			foreach($answers as $answer): 

			$id_user = $answer["id_user"];
			$link_adress = goUserLink($id_user);


			// vérifie la date answer
			$dateCreated = $answer["dateCreated"];
			$dateModified = $answer["dateModified"];
			if (getBetweenDate($dateCreated, $dateModified) == "match"){
				$date = "répondu il y a ".getBetweenDate($dateCreated, "NOW");
			} else {
				$date = "éditer il y a ".getBetweenDate($dateModified, "NOW");
			}

		?>
			<section class="detail-reponses">
					
				<div class="vote">
					<a href="">+</a>
					<a href="">-</a>
				</div>

				<p><?php echo $answer["content"]; ?></p>
				
				<div class="profile_user">
					<p><?php echo $date; ?></p>

					<div>
						<a href="<?php echo $link_adress; ?>">
							<img src="<?php echo $answer["img_profile"]; ?>">
						</a>
						<a href="<?php echo $link_adress; ?>">
							<?php echo $answer["user_pseudo"]; ?>
						</a>
						<p><?php echo $answer["score"]; ?></p>
					</div>
				</div>




				<?php 
					//editer une réponse si la réponse est à utilisateur
					if ($connect && equalUser($my_user["id_user"], $answer["id_user"])): 
					//$link = goUpdateAnswerLink($my_user["id_user"], $id_answer);
				?>
					<a href="<?php //echo $link; ?>">éditer ma réponse ?</a>
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
					if (getBetweenDate($dateCreated, $dateModified) == "match"){
						$date = "répondu il y a ".getBetweenDate($dateCreated, "NOW");
					} else {
						$date = "éditer il y a ".getBetweenDate($dateModified, "NOW");
					}
				?>
					<div class="comment">
						<p><?php echo $comment["content"]; ?></p>

						<div class="comment_profile">
							<a href="<?php echo $link_adress; ?>">
								<?php echo $comment["user_pseudo"]; ?>
							</a>
							<p><?php echo $date; ?></p>
						</div>
					</div>
				<?php endforeach; ?>



				<?php
					// lien vers creation commmentaire
					$link = "index.php?page=signup";
					if ($connect) $link = goCommentLink($my_user["id_user"], $answer["id_answer"], "answer"); 
				?>
				<a href="<?php echo $link; ?>">ajouter un commentaire ?</a>



			</section>
		<?php endforeach; ?>


		<?php
			// lien vers creation réponse
			$link = "index.php?page=signup";
			if ($connect) $link = goAnswerLink($my_user["id_user"], $id_question);
		?>
		<a href="<?php echo $link; ?>">ajouter une réponse ?</a>



	</main>