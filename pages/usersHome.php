<?php
	
	$users = selectUsersHome();


	$my_user = array();
	$connect = userIsLogged();

	// si session ouverte
	if ($connect) $my_user = $_SESSION["user"];

?>

	<main class="container">

		<section id="allUsers">

			<div id="title">
				<h1>Utilisateurs</h1>
			</div>
			
			<div id="users">
			<?php 
				foreach ($users as $user):
				$id_user= $user['id_user'];
			?>
				
				
				<div class="user">
					<a id="profile" href="<?php echo goUserLink($id_user); ?>" >
						<img width="60px" height="60px" src="<?php echo $user['img_profile']; ?>" >
					</a>
					
					<div>
						<a id="pseudo" href="<?php echo goUserLink($id_user); ?>" ><?php echo $user['user_pseudo']; ?></a>

						<p><?php echo (!empty($user['country'])) ? $user['country'] : "pays non renseigné"; ?></p>
						<p>Score :<?php echo $user['score']; ?></p>


						<?php
							// date
							$dateCreated = $user['dateCreated'];
							$date = "membre depuis ".getBetweenDate($dateCreated);
						?>
						<p><?php echo $date; ?></p>


						<span>
							<p>Questions : <?php echo $user['TotalQuestions']; ?></p>
							<p>Réponses : <?php echo $user['TotalAnswers']; ?></p>
						</span>
					</div>
				</div>

				<?php endforeach; ?>	
				
			</div>
		</section>
	</main>