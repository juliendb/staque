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
	$lik_user = $question["id_user"];

?>

	<main class="container">
		<section class="detail-question">

			<div class="title-question">
				<a href=""><?php echo $title; ?></a>
			</div>

			<div class="content-question">
				<p>
					<?php echo $content; ?>
				</p>
			</div>

			<div class="profile_user">
				<p><?php echo $question["dateCreated"]; ?></p>
				<div>
					<a href="<?php echo $link_user; ?>"><img src="<?php echo $question["img_profile"]; ?>"></a>
					<a href="<?php echo $link_user; ?>"></a>
					<p><?php echo $question["score"]; ?></p>
				</div>
			</div>
			
			<?php 
				$comments = selectComments($id_question, "question");
				foreach($comments as $comment):
			?>
			<div class="comment">
				<p><?php echo $comment["content"]; ?></p>
			</div>

		</section>


		
		<?php 
			$reponses = selectAnswers($id_question);
			foreach($reponses as $reponse): 

			$link_user = $reponse["id_user"];
		?>
			<section class="detail-reponses">
					
				<div class="vote">
					<a href="">+</a>
					<a href="">-</a>
				</div>

				<p><?php echo $reponse["content"]; ?></p>
				
				<div class="profile_user">
					<p><?php echo $reponse["dateCreated"]; ?></p>
					<div>
						<a href="<?php echo $link_user; ?>"><img src="<?php echo $reponse["img_profile"]; ?>"></a>
						<a href="<?php echo $link_user; ?>"></a>
						<p><?php echo $reponse["score"]; ?></p>
					</div>
				</div>

			</section>
		<?php endforeach; ?>

	</main>