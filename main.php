<!DOCTYPE html>

<html>
	<head>
		<?php
		error_reporting(E_ALL);
			session_start();
			if(!isset($_SESSION["username"])){
				header("Location: index.php");
				die();
			}				
		?>
	
		<?php echo "<title>Welcome " . $_SESSION["username"] . "</title>"; ?>
		
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, user-scalable=no">
		
		<!--Load jquery and jquery ui -->
		<script src="js/jquery-1.11.1.js"></script>
		<script src="jquery-ui-1.11.1.custom/jquery-ui-1.11.1.custom/jquery-ui.js"></script>
		<script src="jquery-ui-1.11.1.custom/jquery-ui-1.11.1.custom/jquery-ui.js"></script>		
		<link rel="stylesheet" href="jquery-ui-1.11.1.custom/jquery-ui-1.11.1.custom/jquery-ui.css" />
		<link rel="stylesheet" href="jquery-ui-1.11.1.custom/jquery-ui-1.11.1.custom/jquery-ui.structure.css" />
		<link rel="stylesheet" href="jquery-ui-1.11.1.custom/jquery-ui-1.11.1.custom/jquery-ui.theme.css" />
		
		<!--Load timepicker-->
		<script src="datetimepicker/jquery.datetimepicker.js"></script>
		<link rel="stylesheet" href="datetimepicker/jquery.datetimepicker.css" />
		
		<link rel="stylesheet" href="css/user.css"/>
		
		<script src="js/cookieTest.js"></script>
		<script src="js/cookies.js"></script>
		
	</head>
	
	<body>
		<div id="overlay">
			<div id="create-task">
				<form id="create-task-form" action="addTask.php" method="POST">
					<label for="name" style="margin-top: 0px;">Task Name: </label>
					<input type="text" name="name"/> <br />
					<label for="due-date">Due Date(mm/dd/yyyy): </label>
					<input id="datepicker" type="text" name="due-date" /> <br />
					<label for="due-time">Time Due(hh:mm): </label>
					<input id="timepicker" type="text" name="due-time" /> <br />
					<input id="cancel-add" style="margin-left: 65px; margin-right: 60px; margin-top: 20px;" type="button" name="cancel" value="Cancel" />
					<input type="submit" style="margin-top: 20px;" name="submit" value="Submit" />
				</form>
			</div>
		</div>
		
		<div id="page" class="container">
			<div id="header">
				<div id="add-task">+</div>
				<?php echo "<div id=\"title\">View your tasks, ". $_SESSION["username"] . "</div>"; ?>
				<div id="date"></div>
				<div id="time"></div>		
				<a href="logout.php">Logout</a>
				<!--<div id="open-menu">></div>
				<div id="side-menu"></div>-->
			</div>
			<div id="tasks">
				<?php 
					$dbconnection = require("dbconnection.php");
					require("dbaccess.php");
					
					getTasksByUserId($dbconnection, $_SESSION["username"]);									
				?>		
			</div>
		</div>
	</body>

	<script src="js/user.js"></script>
</html>