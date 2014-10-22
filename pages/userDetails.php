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
			
			<div class="infosUser">
				<img src="<?php echo $user['img_profile']; ?>" >
				<a href="<?php echo goUserLink($id_user); ?>" ><?php echo $user['user_pseudo']; ?></a>
				<!--<p>Status</p>-->
				<p><?php echo $user['score']; ?></p>
			</div>

			<div class="infosUserBis">
				
				<?php foreach ($linksUser as $linkUser): ?>
					<a href="<?php echo $linkUser['link']; ?>"><?php echo $linkUser['link']; ?></a>
				<?php endforeach; ?>


				<p><?php echo $user['language']; ?></p>
				<p><?php echo $user['country']; ?></p>
				<p><?php echo $user['job']; ?></p>	
			</div>

			<div class="infosUserTer">

				<?php
					$dateCreated = $user['dateCreated'];
					$date = "membre depuis ".getBetweenDate($dateCreated, "NOW");
				?>

				<p><?php echo $date; ?></p>
				<p><?php echo $user['TotalQuestions']; ?></p>
				<p><?php echo $user['TotalAnswers']; ?></p>	
			</div>



			<div class="button">
				<?php if ($connect && equalUser($my_user["id_user"], $id_user)): ?>
					<a href="<?php echo goUpdateUserLink($my_user['id_user']); ?>">Editer le profil</a>
				<?php endif; ?>
			</div>
		</section>
		
	</main>