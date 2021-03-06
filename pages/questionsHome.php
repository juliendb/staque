<?php 
	
	$_SESSION['url'] = "index.php?page=questionsHome";



	$my_user = array();
	$connect = userIsLogged();

	// si session ouverte
	if ($connect) $my_user = $_SESSION["user"];


	$questions = selectQuestionsHome();

	if (!empty($_GET['no_answers'])) $questions = selectQuestionsHomeNo();
	if (!empty($_GET['tag'])) $questions = selectQuestionsHomeTag($_GET['tag']);

	$date = "";
?>


	<main class="container">

		<h1>Les dernières questions</h1>

		<?php 
			// boucle sur questions
			foreach ($questions as $question):
			$id_question = $question["id_question"];
			$link_question = goQuestionLink($id_question);
			
			// vérifie la date question
			$dateCreated = $question["dateCreated"];
			$dateModified = $question["dateModified"];

			if (getBetweenDate($dateCreated, $dateModified) == "1 seconde(s)") {
				$date = "posée il y a ".getBetweenDate($dateCreated);		
			} else {
				$date = "éditer il y a ".getBetweenDate($dateModified);
			}
		?>

			<section id="questionBloc">

				<div <?php if ($question["TotalReponses"] > 0){ ?> class="utils" <?php }else{ ?> class="utilsNone" <?php } ?> >
					<a href="<?php echo $link_question; ?>"><?php echo $question["TotalReponses"]; ?></a>
				</div>
				
				<div class="questionDetails">
					<div class="title-question">
						<a href="<?php echo $link_question; ?>"><?php echo $question["title"]; ?></a>
					</div>
				

					<div class="infosUser">
						<p><?php echo $date; ?></p>
						<a href="<?php echo goUserLink($question['id_user']); ?>"><?php echo $question["user_pseudo"]; ?></a>
						
						<p class="score"><?php echo $question["score"]; ?></p>
					</div>

					<?php
					//boucle sur les tags
					$tags = selectTagsQuestion($id_question);
					foreach ($tags as $tag):
					?>

					<div class="tags_questions">
						<a href="<?php echo 'index.php?page=home&tag='.$tag['id_tag']; ?>"><?php echo $tag["tag_name"]; ?></a>
					</div>

				<?php endforeach; ?>

				</div>
				<div class="clearboth"></div>
				


				<?php 
					//editer une question si la question est à utilisateur
					if ($connect && equalUser($my_user["id_user"], $question["id_user"])): 
					$link = goUpdateQuestionLink($id_question);
				?>
					<a class="editer" href="<?php echo $link; ?>">éditer ma question ?</a>
				<?php endif; ?>
				

			</section>

		<?php endforeach; ?>

	</main>