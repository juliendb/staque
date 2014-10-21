<?php
	// home page
	function home(){
		showPage();
	}


	
	// inscription et login 
	function signup(){
		showPage();
	}

	function login(){
		showPage();
	}



	// affiche questions home et autres
	function questionsHome(){
		showPage();
	}

	function questionDetails(){
		showPage();
	}

	function questionCreate(){
		showPage();
	}


	// affiche page user et autres
	function userDetails(){
		showPage();
	}


	function userEdit(){
		showPage();
	}

	function usersHome(){
		showPage();
	}


	// Fonctions include de pages
	function showPage(){
		global $page;
		include("pages/".$page.".php");
	}