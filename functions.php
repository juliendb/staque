<?php

	function home(){
		//aller chercher les questions enbdd
		//$questions = getHomeQuestions();
		showPage();
	}


	function contact(){
		$data = $_POST;
		//validation...
		showPage();
	}


	function services(){
		showPage();
	}

	function questions(){
		showPage();
	}


	function signup(){
		showPage();
	}

	function login(){
		showPage();
	}

	function questionDetails(){
		showPage();
	}
	

	function userDetails(){
		showPage();
	}

	// Fonctions include de pages
	function showPage(){
		global $page;
		include("pages/".$page.".php");
	}

	function getHomeQuestions()
	{
		
	}