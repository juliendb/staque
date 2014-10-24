<?php

	$id_user = 0;
	if(empty($_GET['id_user'])) {
		goHome();
	} else {

		$id_user = $_GET['id_user'];
	}


	$my_user = array();
	$connect = userIsLogged();

	// si session ouverte
	if ($connect) $my_user = $_SESSION["user"];




	$user = selectUserDetail($id_user);
	$linksUser = selectLinkUser($id_user);


?>

	<main class="container">
		<section id="userDetails">
			

			<div class="user">
				<a id="profile" href="<?php echo goUserLink($id_user); ?>" >
					<img width="120px" height="120px" src="<?php echo $user['img_profile']; ?>" >
				</a>
				
				<div>
					<a id="pseudo" href="<?php echo goUserLink($id_user); ?>" ><?php echo $user['user_pseudo']; ?></a>

					<p><?php echo (!empty($user['user_name'])) ? $user['user_name'] : "nom non renseigné"; ?></p>
					<p><?php echo (!empty($user['language'])) ? $user['language'] : "langue non renseigné"; ?></p>
					<p><?php echo (!empty($user['country'])) ? $user['country'] : "pays non renseigné"; ?></p>
					<p><?php echo (!empty($user['job'])) ? $user['job'] : "métier non renseigné"; ?></p>
					<p>Score :<?php echo $user['score']; ?></p>


					<?php foreach ($linksUser as $linkUser): ?>
						<a href="<?php echo $linkUser['link']; ?>"><?php echo $linkUser['link']; ?></a>
					<?php endforeach; ?>


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




			<div class="form-group">
				<?php if ($connect && equalUser($my_user["id_user"], $id_user)): ?>
					<a href="<?php echo goUpdateUserLink($my_user['id_user']); ?>">Editer le profil</a>
				<?php endif; ?>
			</div>
		</section>
		
	</main>