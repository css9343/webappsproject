<?php
	$dbconnection = require("dbconnection.php");
	require("dbaccess.php");

	$taskId = $_GET["id"];
	removeTask($dbconnection, $taskId);

	header("Location: main.php");
	die();
?>