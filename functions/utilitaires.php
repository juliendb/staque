<?php 


	function goHome()
	{
		header("Location: index.php");
		die();
	}


	//fonction go user

	function goUserLink($id_user) 
	{
		return "index.php?page=userDetails&id_user=" . $id_user;
	}

	function goQuestionLink($id_question) 
	{
		return "index.php?page=questionDetails&id_question=" . $id_question;
	}