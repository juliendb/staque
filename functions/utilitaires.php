<?php 


	function goHome()
	{
		header("Location: index.php?page=home");
		die();
	}




	// affiche la différence entre la date actuel et une autre date
	/*$text = getBetweenDate("2014-10-18 19:16:24", "2014-10-18 19:16:24");
	if ($text == "0 seconde(s)") echo "1";*/
	function getBetweenDate($date1, $date2)
	{
		date_default_timezone_set('Europe/Paris');
		$date1 = date($date1);
		
		// si date == now
		if ($date2 == "NOW") $date2 = date("Y-m-d H:i:s");
		else $date2 = date("$date2");
		

		$dateFrom = new DateTime($date1);
		$dateNow = new DateTime("$date2");


		$interval = $dateNow->diff($dateFrom);

		//Différence entre les 2 dates : 0 ans 6 mois 16 jours 19 heures 14 minutes 28 secondes
		//print_r($interval->format('%y ans %m mois %d jours %h heures %i minutes %s secondes'));

		$diff_s = $interval->format('%s');
		$diff_i = $interval->format('%i');
		$diff_h = $interval->format('%h');
		$diff_d = $interval->format('%d');
		$diff_m = $interval->format('%m');
		$diff_y = $interval->format('%y');


		// si il n'y a pas de différences
		if ($diff_s < 60) $text = $diff_s." seconde(s)";
		if ($diff_s >= 60 || $diff_i >= 1) $text = $diff_i." minute(s)";
		if ($diff_i >= 60 || $diff_h >= 1) $text = $diff_h." heure(s)";
		if ($diff_h >= 24 || $diff_d >= 1) $text = $diff_d." jour(s)";
		if ($diff_m >= 1) $text = $diff_m." mois et ".$diff_d." jour(s)";
		if ($diff_y >= 1) $text = $diff_y." an(s) et ".$diff_m." mois";

		if ($text == "0 seconde(s)") $text = "match";

		// retourne texte
		return $text;
	}




	//fonction go user
	function goUserLink($id_user) 
	{
		return "index.php?page=userDetails&id_user=" . $id_user;
	}

	// fonction go question
	function goQuestionLink($id_question) 
	{
		return "index.php?page=questionDetails&id_question=" . $id_question;
	}