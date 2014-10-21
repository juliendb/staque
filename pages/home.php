<?php 
	// appel de base les questions sur la home page
	$page = "questionsHome";

	if (function_exists($page)){
		call_user_func($page);	
	}