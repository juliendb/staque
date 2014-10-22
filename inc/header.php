<?php 
	
	$my_user = array();
	$link = "index.php?page=";

	$connect = userIsLogged();

	// si session ouverte
	if ($connect) $my_user = $_SESSION["user"];


	// change lien en fonction de si on est connecter
	if ($connect) $askQuestion = "questionCreate&id_user=".$my_user["id_user"];
	if (!$connect) $askQuestion = "signup";


	$members = selectTotalMembers();
?>
	


	<header id="header">
		<div id="connection" >
			<div class="container">
				<div id="logo"></div>

				<div id="sign">
					<?php if (!$connect): ?>
						<a href="<?php echo $link.'signup'; ?>">s'inscrire</a> 
						<a href="<?php echo $link.'login'; ?>">se connecter</a>
					<?php endif; ?>

					<?php if ($connect): ?>
						<p><?php echo "Bonjour ".$my_user["user_pseudo"]; ?></p>
						<a href="<?php echo $link.'logout'; ?>">se déconnecter</a>
					<?php endif; ?>
				</div>

				<form id="search">
					<input type="text" value="search">
				</form>
			</div>
		</div>

		<div id="mainHeader">
			<div class="container">
				<nav id="menu">
					<a href="<?php echo $link.'questionsHome'; ?>">Questions</a>
					<a href="<?php echo $link.'usersHome'; ?>">Utilisateurs</a>
					<a href="">Sans réponses</a>
				</nav>

				<div id="askQuestion">
					<label for="askQuestion"></label>
					<a href="<?php echo $link.$askQuestion; ?>">Poser une question</a>
				</div>
			</div>	
		</div>


		<p><?php echo $members["0"]." utilisateurs" ?></p>
		<p><?php echo $members["1"]." connectés" ?></p>

	</header>