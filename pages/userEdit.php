<?php
	


	$errors = array();

	//mes variables
	$user_name	= "";
	$email		= "";
	$language	= "";
	$job		= "";
	$country	= "";
	$img_profile = "";








	//fonction pour créer un array qui va récupérer l'id de user
	$id_user = 0;
	if(empty($_GET['id_user'])) {
		die('404');
	} else {

		$id_user = $_GET['id_user'];
	}

	$user = selectUserDetail($id_user);

	$linksUser = selectLinkUser($id_user);


	$user_name	= $user['user_name'];
	$email		= $user['email'];
	$language	= $user['language'];
	$job		= $user['job'];
	$country	= $user['country'];







	//est-ce que le form a été soumis
	if (!empty($_POST)){


		//récupère les données dans mes variables
		$user_name		= $_POST['user_name'];
		$email 			= $_POST['email'];
		$language 		= $_POST['language'];
		$job 			= $_POST['job']; 
		$country 		= $_POST['country'];


		/*
		*	 début de la validation
		*/
		//user_name est valide et si il n'existe pas
		if ( isValidName($user_name) ) {
			$errors[] = isValidName($user_name);
		}
	

		//email est est valide et si il n'existe pas
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$errors[] = "Votre email n'est pas valide !";
		}


	


		//si le form est valide, envoit le message
		if(empty($errors)){
	
		
			updateUserDetail($id_user, $user_name, $email, $language, $job, $country, $img_profile);
		}
	} 






?>

	<main class="container">

		<section id="userEdit">
			<form = class="editProfile" method="POST">

				<div class='imageUser'>
					<img src="<?php //echo $user['img_profile']; ?>" >

					<label for="image">Image à télécharger</label><br />
					<input type="file" name="image" id="image" />
				</div>

				<input type="submit" value="Télécharger" />

				<div class="form-group">
					<label for="user_name">Entrez votre nom</label>
					<input type="text" name="user_name" id="user_name" value="<?php echo $user['user_name']; ?>" />

					<?php if (!empty($errors['user_name'])): ?>
					
					<?php endif; ?>
				</div>
			
				<div class="form-group">
					<label for="email">Entrez votre email</label>
					<input type="text" name="email" id="email" value="<?php echo $user['email']; ?>" />

					<?php if (!empty($errors['email'])): ?>
				
					<?php endif; ?>
				</div>

				<div class="form-group">
					<label for="country">Entrez votre pays</label>
					<input type="text" name="country" id="country" value="<?php echo $user['country']; ?>" />
				</div>

				<div class="form-group">
					<label for="language">Entrez votre langue</label>
					<input type="text" name="language" id="language" value="<?php echo $user['language']; ?>" />

					<?php if (!empty($errors['language'])): ?>
				
					<?php endif; ?>
				</div>

				
				<div class="form-group">
					<label for="job">Entrez votre métier</label>
					<input type="text" name="job" id="job" value="<?php echo $user['job']; ?>" />

					<?php if (!empty($errors['job'])): ?>
				
					<?php endif; ?>
				</div>

			

				<div class="form-group" id="linksUsers">
					<p><?php echo $user['dateCreated']; ?></p>
					<p><?php echo $user['TotalQuestions']; ?></p>
					<p><?php echo $user['TotalAnswers']; ?></p>	
				</div>

				<div class="form-group">
					<div class="fake-label"></div>
					<input type="submit" id="valider" value="Valider" />
					
				</div>

			</form>
		</section>
		
	</main>