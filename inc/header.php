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
		<div id="access">
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

		<nav id="menu">
			<a href="<?php echo $link.'questionsHome'; ?>">Questions</a>
			<a href="<?php echo $link.'usersHome'; ?>">Utilisateurs</a>
			<a href="">Sans réponses</a>
		</nav>

		<div id="askQuestion">
			<label for="askQuestion">
			<a href="<?php echo $link.$askQuestion; ?>">Poser une question</a>
		</div>


		<p><?php echo $members["0"]." utilisateurs" ?></p>
		<p><?php echo $members["1"]." connectés" ?></p>
	</header>