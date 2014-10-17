<?php

	function home(){
		//aller chercher les questions enbdd
		//$questions = getHomeQuestions();
		showPage();
	}

	function questions(){
		//aller chercher les questions enbdd
		//$questions = getHomeQuestions();
		showPage();
	}

	function contact(){
		$data = $_POST;
		//validation...
		showPage();
	}


	// Fonctions include de pages

	function showPage(){
		global $page;
		include("pages/".$page.".php");
	}

	function getHomeQuestions(){
		
	}