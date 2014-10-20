<?php

	//fonction pour créer un array qui va récupérer
	$id_user = 0;
	if(empty($_GET['id_user'])) {
		die('404');
	} else {

		$id_user = $_GET['id_user'];
	}

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
				<p><?php echo $user['dateCreated']; ?></p>
				<p><?php echo $user['TotalQuestions']; ?></p>
				<p><?php echo $user['TotalAnswers']; ?></p>	
			</div>

			<form class="button">
				<a href="index.php?page=editUser&id_user=<?php echo $id_user; ?>">Editer le profil</a>
			</form>
		</section>
		
	</main>