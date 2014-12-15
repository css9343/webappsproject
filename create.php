<?php
error_reporting(E_ALL);
session_start();

function sendError($code, $message)
{
	http_response_code($code);
	$response_array = array("status" => "error", "message" => $message);
	echo json_encode($response_array);
	die();
}

//Check if they sent a username
if(!empty($_POST["username"])){
	
	//Check if the sent a password
	if(!empty($_POST["password"])){
		
		//Check if they sent a confirm password
		if(!empty($_POST["confirm"])){
			
			//Check if the password and the confirm match
			if($_POST["password"] == $_POST["confirm"]){
				
				//There will be a call here to the db to check if the username doesnt already exist
				$dbconnection = require("dbconnection.php");
				require("dbaccess.php");
				
				$test = verifyUsername($dbconnection, $_POST["username"]);
				
				if($test == false)
				{
					header("Location: index.php?error=c5");
					die();
				}
				else{
					addUser($dbconnection, $_POST["username"], $_POST["password"]);
					$_SESSION["username"] = $_POST["username"];
					$_SESSION["password"] = $_POST["password"];
					header("Location: main.php");
					die();
				}
			}
			else{
				header("Location: index.php?error=c4");
				die();
			}
			
		}
		else{
			header("Location: index.php?error=c3");
			die();
		}
	}
	else{
		header("Location: index.php?error=c2");
		die();
	}
	
}
else{
	header("Location: index.php?error=c1");
	die();
}

?>