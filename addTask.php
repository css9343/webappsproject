<?php
	session_start();

	$dbconnection = require("dbconnection.php");
	require("dbaccess.php");

	if(!empty($_POST["name"]) && !empty($_POST["due-date"]) && !empty($_POST["due-time"]))
	{
		$taskName = $_POST["name"];
		$dueDate = $_POST["due-date"];
		$dateParts = explode("/", $dueDate); //mm/dd/yyyy
		$dueTime = $_POST["due-time"];		
		$timeParts = explode(":", $dueTime); //hh:mm
		$user = $_SESSION["username"];

		//Set up hours, minutes, and am/pm
		$hour = "";
		$minutes = "";
		$ampm = "";
		
		if($timeParts[0] > 12){
			$hour = $timeParts[0] - 12;
			$ampm = "PM";
		}
		else{
			$hour = $timeParts[0];
			$ampm = "AM";
		}
	
		if($timeParts[1] == 00 || $timeParts[1] == 0){
			$minutes = "00";
		}
		else{
			$minutes = $timeParts[1];
		}
		
		//addTask($db, $user, $name, $day, $month, $year, $hours, $minutes, $ampm)		
		addTask($dbconnection, $user, $taskName, $dateParts[1], $dateParts[0], $dateParts[2], $hour, $minutes, $ampm);
		header("Location: main.php");
		die();
	}
	else
	{
		header("Location: main.php");
		die();
	}
?>