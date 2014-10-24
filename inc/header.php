<?php 
	
	$my_user = array();
	$link = "index.php?page=";

	$connect = userIsLogged();

	// si session ouverte
	if ($connect) $my_user = $_SESSION["user"];


	// change lien en fonction de si on est connecter
	if ($connect) $askQuestion = "questionCreate";
	if (!$connect) $askQuestion = "signup";


	$members = selectTotalMembers();
?>
	
	

	<header id="header">
		<div id="connection" >

			<div class="container">
				<div id="logo"></div>

				<div id="sign">
					<form id="search">
						<input type="text" value="">
						<input type="submit" value="">
					</form>

					<?php if (!$connect): ?>

						<a href="<?php echo $link.'signup'; ?>">s'inscrire</a>

						
						<div class="pictohead"></div> 
						<a href="<?php echo $link.'login'; ?>">se connecter</a>
					<?php endif; ?>

					<?php if ($connect): ?>
						<p><?php echo "Bonjour ".$my_user["user_pseudo"]; ?></p>
						<div class="pictohead"></div>
						<a href="<?php echo $link.'logout'; ?>">se déconnecter</a>
					<?php endif; ?>
				</div>
			</div>

		</div>


		<div id="mainHeader">
			<div class="container">

				<div id="help">
					<a href=""></a>
				</div>
			
				<div id="askQuestion">
					<a href="<?php echo $link.$askQuestion; ?>">Poser une question</a>
				</div>		

				<nav id="menu">
					<a href="<?php echo $link.'questionsHome'; ?>">Questions</a>
					<a href="<?php echo $link.'usersHome'; ?>">Utilisateurs</a>

					<a href="<?php echo $link.'questionsHome&no_answers=now'; ?>">Sans réponses</a>

					<div id="illustration">
						<img src="img/illustration.png" height="271" width="303">
					</div>

					

				</nav>
				
			</div>	


			
		</div>


		<p><?php //echo $members["0"]." utilisateurs" ?></p>
		<p><?php //echo $members["1"]." connectés" ?></p>

	</header>