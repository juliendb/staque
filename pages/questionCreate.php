<?php
		

	$my_user = array();
	$connect = userIsLogged();

	// si session ouverte
	if ($connect) $my_user = $_SESSION["user"];




	$id_user = 0;
	if (!$connect) {
		goHome();
	
	} else {
		$id_user = $my_user['id_user'];
	}


	$numb_tags = 5;

	$tags = array();
	$errors = array();
	$listTags = array();


	$title = "";
	$content = "";



	if (!empty($_POST))
	{
		$title			= $_POST['title'];
		$content 		= $_POST['content'];




		// boucle tags
		for($i=0; $i<$numb_tags; $i++)
		{
			if (!empty($_POST[('tag'.$i)]))
			{
				if (selectIDTag($_POST[('tag'.$i)]))
				{
					$tag_name = selectIDTag($_POST[('tag'.$i)]);
					$tags[] = $tag_name["tag_name"];
					
				} else {

					insertNewTag($_POST[('tag'.$i)]);
					$tags[] = $_POST[('tag'.$i)];
				}
			}
		}


		if (empty($errors) && !empty($tags))
		{
			$id_tags = array();
			
			foreach ($tags as $key)
			{
				$id_tag = selectIDTag($key);
				$id_tags[] = $id_tag;
			}

			insertQuestion($id_user, $title, $content, $id_tags);
		}
	}


?>

	<main class="container">
		<form id="createQuestion" method="POST" novalidate>
			
			<div class="form-group">
				<input type="text" name="title" id="title" value="<?php echo $title; ?>" placeHolder="Entrer le titre de votre question"/>
			</div>

			<div class="form-group">
				<textarea name="content" id="contentEdit" rows="10" cols="40">
					<?php echo $content; ?>
				</textarea>
			</div>
			
			
			<div class="form-group">
				<?php

					for($i=0; $i<$numb_tags; $i++):
				?>
					<div>
						<input type="text" name="<?php echo ('tag'.$i); ?>" placeHolder="Séléctioner le tag <?php echo ($i+1); ?>" value="<?php echo (!empty($tags[$i]) ) ? $tags[$i] : ""; ?>">
					</div>

				<?php endfor; ?>
			</div>

			
			<div class="form-group">
				<input type="submit" name="valider">
			</div>


		</form>
	</main>
