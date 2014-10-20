<?php
	
	$id_question = 0;
	if (empty($_GET['id_question']))
	{
		die("404");
	
	} else {
		$id_question = $_GET['id_question'];
	}

	

	$question = selectQuestion($id_question);

	$title = $question["title"];
	$content = $question["content"];

	$id_user = $question["id_user"];
	$link_adress = goUserLink($id_user);

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
					<a href="<?php echo $tag["id_tag"]; ?>">
						<?php echo $tag["tag_name"]; ?>
					</a>
				</div>

			<?php endforeach; ?>


			<div class="profile_user">
				<p><?php echo $question["dateCreated"]; ?></p>
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
				// boucle de commentraires
				$comments = selectComments($id_question, "question");
				foreach($comments as $comment):

				$id_user = $comment["id_user"];
				$link_adress = goUserLink($id_user);
			?>
				<div class="comment">
					<p><?php echo $comment["content"]; ?></p>
					<div class="comment_profile">
						<a href="<?php echo $link_adress; ?>">
							<?php echo $comment["user_pseudo"]; ?>
						</a>
						<p><?php echo $comment["dateCreated"]; ?></p>
					</div>
				</div>
			<?php endforeach; ?>

		</section>


		
		<?php 
			//boucle sur les réponses
			$answers = selectAnswers($id_question);
			foreach($answers as $answer): 

			$id_user = $answer["id_user"];
			$link_adress = goUserLink($id_user);

		?>
			<section class="detail-reponses">
					
				<div class="vote">
					<a href="">+</a>
					<a href="">-</a>
				</div>

				<p><?php echo $answer["content"]; ?></p>
				
				<div class="profile_user">
					<p><?php echo $answer["dateCreated"]; ?></p>
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
					// boucle de commentraires
					$comments = selectComments($answer["id_answer"], "answer");
					foreach($comments as $comment):

					$id_user = $comment["id_user"];
					$link_adress = goUserLink($id_user);
				?>
					<div class="comment">
						<p><?php echo $comment["content"]; ?></p>

						<div class="comment_profile">
							<a href="<?php echo $link_adress; ?>">
								<?php echo $comment["user_pseudo"]; ?>
							</a>
							<p><?php echo $comment["dateCreated"]; ?></p>
						</div>
					</div>
				<?php endforeach; ?>

			</section>
		<?php endforeach; ?>

	</main>