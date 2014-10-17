<?php

	session_start();
	include("inc/db.php");
	
	//html 
	include("inc/top.php");
	include("inc/header.php");

	//inclus fonctions php
	include("functions.php");

	$page = "home";
	if (!empty($_GET['page'])){
		$page = $_GET['page'];
	}

	if (function_exists($page)){
		call_user_func($page);	
	}




	//html
	include("inc/bottom.php");
