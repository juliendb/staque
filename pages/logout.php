<?php
	
	$connect = userIsLogged();

	// si session ouverte
	if ($connect) $user = $_SESSION["user"];
	updateStatus($user["id_user"], "deconnected");


	session_destroy();
	unset($_SESSION);
	setcookie("PHPSESSID", "", 0);
	
	goHome();