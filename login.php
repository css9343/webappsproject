<?php
error_reporting(E_ALL);
session_start();

//Check if they sent a username
if(isset($_POST["username"]) && $_POST["username"] != ""){
	
	//Check if they sent a password
	if(isset($_POST["password"]) && $_POST["password"] != ""){
		
		$dbconnection = require("dbconnection.php");
		require("dbaccess.php");
		
		$login = dblogin($dbconnection, $_POST["username"], $_POST["password"]);
		
		if($login == true){
			$_SESSION["username"] = $_POST["username"];
			$_SESSION["password"] = $_POST["password"];
			header("Location: main.php");
			die();
		}
		else{
			header("Location: index.php?error=l3");
			die();
		}
		
	}else{
		//Tell the homepage to display error that they forgot to enter a password
		header("Location: index.php?error=l2");
		die();  
	}
}else{
	
	//Telling the homepage to display error that they did not enter a username
	header("Location: index.php?error=l1");
	die();
}

?>