<?php
	
	$id_user = 0;
	if (empty($_GET['id_user']))
	{
		die("404");
	
	} else {
		$id_user = $_GET['id_user'];
	}


	$tags = array();
	$errors = array();
	$listTags = array();


	$titleQuestion = "";
	$contentQuestion = "";



	if (!empty($_POST))
	{
		$titleQuestion 			= $_POST['titleQuestion'];
		$contentQuestion 		= $_POST['contentQuestion'];


		// boucle tags
		for($i=0; $i<5; $i++)
		{
			if (!empty($tags[$i])) $tags[$i] = $_POST[('tag'.$i)];
			print_r($tags);

			// insere tags et remplis l'arrau
			if (selectIDTag($tags[$i])) echo "toto";
			//if ($tags[$i] != "") $listTags[] = insertNewTag();
		}


		if (empty($errors))
		{

		}
	}


?>

	<main class="container">
		<form id="createQuestion" method="POST" novalidate>
			
			<div class="form-group">
				<label for="titleQuestion">Entrez le nom de votre question</label>
				<input type="text" name="titleQuestion" id="titleQuestion" value="<?php echo $titleQuestion; ?>" />
			</div>

			<div class="form-group">
				<label for="contentQuestion">Saisissez le contenu de votre question</label>
				<textarea name="contentQuestion" id="contentQuestion">
					<?php echo $contentQuestion; ?>
				</textarea>  
			</div>
			
			
			<div class="form-group">
				<?php

					for($i=0; $i<5; $i++):
				?>
					<div>
						<p><?php echo "tag ".($i+1); ?></p>
						<input type="text" name="<?php 'tag'.$i; ?>" value="<?php echo $tags[$i]; ?>">
					</div>

				<?php endfor; ?>
			</div>

			
			<div class="form-group">
				<input type="submit" name="valider">
			</div>


		</form>
	</main>
