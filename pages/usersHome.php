<?php
	
	$users = selectUsersHome();

?>

	<main class="container">

		<section id="allUsers">

			<div id="title">
			<h1>Utilisateurs</h1>
			</div>

			<div class="users">
			<?php 
				foreach ($users as $user):
				$id_user= $user['id_user'];
			?>
				
				
				<div id="user">
					<a href="<?php echo goUserLink($id_user); ?>" ><img src="<?php //echo $user['img_profile']; ?>" ></a>
					<a href="<?php echo goUserLink($id_user); ?>" ><?php echo $user['user_pseudo']; ?></a>


					<p><?php echo $user['country']; ?></p>
					<p>Score :<?php echo $user['score']; ?></p>
					<p>Questions :<?php echo $user['TotalQuestions']; ?></p>
					<p>Score :<?php echo $user['TotalAnswers']; ?></p>
				</div>

				<?php endforeach; ?>	
				
			</div>
		</section>
	</main>