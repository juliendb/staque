<?php
	
	$id_answer = 0;
	$vote_type = 0;
	$id_userAnswer = 0;
	
	
	$my_user = array();
	$connect = userIsLogged();

	// si session ouverte
	if ($connect) $my_user = $_SESSION["user"];

	$id_user = $my_user["id_user"];



	function emptyGet()
	{
		if (empty($_GET['id_answer']) || 
			empty($_GET['vote_type'] && $_GET['vote_type'] != 0) ||
			empty($_GET['id_userAnswer'])) {
			return true;
		}

		return false;
	}

	
	if (!$connect) header("Location: index.php?page=signup");

	if (emptyGet() || !$connect) {
		
		$redirection = $_SESSION['url'];
		header("Location: $redirection");
		

	} else {

		$id_answer 			= $_GET['id_answer'];
		$vote_type 			= $_GET['vote_type'];
		$id_userAnswer 		= $_GET['id_userAnswer'];

		/*
		// empeche user de voter pour sa propre réponse
		if (equalUser($id_user, $id_userAnswer) || selectVote($id_user, $id_answer)) {
			$redirection = $_SESSION['url'];
			header("Location: $redirection");
			die("non !");
		} else {

			insertVote($id_user, $id_answer, $vote_type, $id_userAnswer);
		}*/
	}


	$vote = calculVote($id_answer);

	/*
	// redirige vers page question
	$redirection = $_SESSION['url'];
	header("Location: $redirection");
	*/
	
?>


<div id="test"><p><?php echo $vote; ?></p></div>