<?php

	session_start();
	include("inc/db.php");
	include("inc/top.php");
	include("functions.php");

	$page = "home";
	if (!empty($_GET['page'])){
		$page = $_GET['page'];
	}

	if (function_exists($page)){
		call_user_func($page);	
	}


	include("inc/bottom.php");