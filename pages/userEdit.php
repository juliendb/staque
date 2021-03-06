<?php

	$errors = array();

	//mes variables
	$user_name	= "";
	$email		= "";
	$language	= "";
	$job		= "";
	$country	= "";
	$img_profile = "";



	$my_user = array();
	$connect = userIsLogged();

	// si session ouverte
	if ($connect) $my_user = $_SESSION["user"];





	//fonction pour créer un array qui va récupérer l'id de user
	$id_user = 0;
	if(!$connect) {
		goHome();
	} else {

		$id_user = $my_user['id_user'];
	}

	$user = selectUserDetail($id_user);
	$linksUser = selectLinkUser($id_user);


	$user_name	= $user['user_name'];
	$email		= $user['email'];
	$language	= $user['language'];
	$job		= $user['job'];
	$country	= $user['country'];





	$img_profile = $user["img_profile"];

	// va chercher le lien dans l'url
	if (!empty($_GET['img_profile']))
	{
		$img_profile = $_GET['img_profile'];
	}






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
		if (isValidName($user_name) ) {
			$errors[] = isValidName($user_name);
		}
	

		//email est est valide et si il n'existe pas
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$errors[] = "Votre email n'est pas valide !";
		}



		//si le form est valide, envoit le message
		if(empty($errors))
		{
			updateUserDetail($id_user, $user_name, $email, $language, $job, $country, $img_profile);
		}
	}








	if (!empty($_FILES))
	{	
		if ($_FILES["image"]["error"] == 0)
		{
			// valider taille
			$accepted = array("image/jpeg","image/jpg","image/gif","image/png");

			$tmp_name = $_FILES['image']['tmp_name'];

			$parts = explode(".",  $_FILES['image']['name']);
			$extention = end($parts);

			$filename = uniqid()."_".$my_user["id_user"]. "." .$extention;
			$destination = "uploads/" .$filename;

			$finfo = finfo_open(FILEINFO_MIME_TYPE);
			$mime = finfo_file($finfo, $tmp_name);
			finfo_close($finfo);

			if (in_array($mime, $accepted))
			{
				move_uploaded_file($tmp_name, $destination);



				// manipulation de l'image
				// avec simple image
				require("inc/SimpleImage.php");

				$img = new abeautifulsite\SimpleImage($destination);
				$img->thumbnail(120,120)->save("uploads/thumbs/".$filename);

				$img_profile = "uploads/thumbs/".$filename;
				$link = goUpdateUserLink($id_user)."&img_profile=".$img_profile;
				header("Location: $link");
			}
		}
	}


?>

	<main class="container">

		<section id="userEdit">

			<form enctype="multipart/form-data" method="POST">
				<div class='imageUser'>
					<img src="<?php echo $img_profile; ?>" >

					<label for="image">Image à télécharger</label><br />
					<input type="file" name="image" id="image" />

					<input type="submit" value="Télécharger"/>
				</div>
			</form>


			<form class="editProfile" method="POST">
				<div class="form-group">
					<input type="text" name="user_name" id="user_name" value="<?php echo $user['user_name']; ?>" placeHolder="Renseigner votre nom"/>
				</div>
			
				<div class="form-group">
					<input type="text" name="email" id="email" value="<?php echo $user['email']; ?>" placeHolder="Renseigner votre email"/>
				</div>

				<div class="form-group">
					<input type="text" name="country" id="country" value="<?php echo $user['country']; ?>" placeHolder="Renseigner votre pays"/>
				</div>

				<div class="form-group">
					<input type="text" name="language" id="language" value="<?php echo $user['language']; ?>" placeHolder="Renseigner votre langue"/>
				</div>

				
				<div class="form-group">
					<input type="text" name="job" id="job" value="<?php echo $user['job']; ?>" placeHolder="Renseigner votre métier"/>
				</div>

			

				<div class="form-group" id="linksUsers">
				</div>

				<div class="form-group">
					<input type="submit" id="valider" value="Valider" />
				</div>

			</form>
		</section>
		
	</main>