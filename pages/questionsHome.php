<?php 

	$questions = selectQuestionsHome();
	
?>


	<main class="container">
		<?php 
			// boucle sur questions
			foreach ($questions as $question):
			$id_question = $question["id_question"];
			$link_question = goQuestionLink($id_question);
		?>

			<section class="question">
				<div class="utils">
					<a href="<?php echo $link_question; ?>">
						<?php echo $question["TotalReponses"]; ?>
					</a>
				</div>

				<div class="title-question">
					<a href="<?php echo $link_question; ?>">
						<?php echo $question["title"]; ?>
					</a>
				</div>

				
				<div class="infosUser">
					<p><?php echo $question["dateCreated"]; ?></p>
					<p><?php echo $question["dateModified"]; ?></p>
					<a href="<?php echo goUserLink($question['id_user']); ?>">
						<?php echo $question["user_pseudo"]; ?>
					</a>
					<p><?php echo $question["score"]; ?></p>
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

			</section>

		<?php endforeach; ?>

	</main>