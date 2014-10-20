<?php

	//fonction pour créer un array qui va récupérer
	$id_user = 0;
	if(empty($_GET['id_user'])) {
		die('404');
	} else {

		$id_user = $_GET['id_user'];
	}

	$user = selectUserDetail($id_user);

	print_r($user);

?>

	<main class="container">
		<section id="userDetails">
			

		</section>
		
	</main>