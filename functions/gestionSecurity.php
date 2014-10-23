<?php


	//retourne une chaîne aléatoire, d'une longueur $length
	function randomString($length = 50)
	{
		$chars = "ABCDEFGHIJKLMNOPQRSTRUVWYXZabcdefghijklmnopqrstruvwyxz0123456789";
		$string = "";
		for($i=0;$i<$length;$i++){
			$num = mt_rand(0, strlen($chars)-1);
			$string .= $chars[$num];
		}
		return $string;
	}

	//hache le mot de passe, d'une manière lente
	//utilise un salt unique par utilisateur, et un pepper fixe
	function hashPassword($password, $salt)
	{
		$pepper = "zDO3Byl7rsYAgz6fGAjf4*Ej23dvlAvvmOzFXG3E2m4FTXb4l5o";
		$hashedPassword = hash("sha512", $password);
		for($i=0;$i<5000;$i++){
			$hashedPassword = hash("sha512", $pepper . $hashedPassword . $salt);
		}

		return $hashedPassword;
	}


	// si utilisateur est connécté
	function userIsLogged()
	{
		if (!empty($_SESSION['user'])) return true;
		
		return false;
	}