<?php 
	
	

	if (userIsLogged()) echo "toto";
	
	$connect = userIsLogged();
	//echo userIsLogged();

	// si session ouverte
	if ($connect)
	{
		//echo "toto";
		//print_r(($_SESSION["user"]));
	} else {


	}
	
	

?>
	


	<header id="header">
		<div id="access">
			<div id="sign">
				<?php if (!$connect): ?>
					<a href="">s'inscrire</a> 
					<a href="">se connecter</a>
				<?php endif; ?>

				<?php if ($connect): ?>
					<a href="">se déconnecter</a>
				<?php endif; ?>
			</div>

			<form id="search">
				<input type="text" value="search">
			</form>
		</div>

		<nav id="menu">
			<a href="">Questions</a>
			<a href="">Mots-clés</a>
			<a href="">Utilisateurs</a>
			<a href="">Sans réponses</a>
		</nav>

		<div id="askQuestion">
			<label for="askQuestion">
			<input type="button" value="Poser une question">
		</div>
	</header>