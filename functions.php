<?php

	function home(){
		//aller chercher les questions enbdd
		$questions = getHomeQuestions();
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

	function showPage(){
		global $page;
		include("pages/".$page.".php");
	}

	function getHomeQuestions(){
		
	}