<?php
	error_reporting(E_ALL);
	
	function verifyUsername($db, $username)
	{
		$command = "SELECT username from users";
		$results = mysqli_query($db, $command);
		
		checkError($db);
		
		if($results->num_rows === 0)
		{
			return true;
		}
		else
		{		
			while($row = mysqli_fetch_assoc($results)) {
				if($row["username"] == $username)
					return false;
			}
			
			return true;
		}
	}
	
	function addUser($db, $user, $pass)
	{
		$hash = hash("sha512", $pass);
		$command = "INSERT INTO users (username, password) VALUES ('" . $user . "', '" . $hash . "')";
		mysqli_query($db, $command);

		$exception = mysqli_error($db);

		if(!empty($exception))
		{
			return $exception;
		}

		return NULL;
	}
	
	function dblogin($db, $user, $pass)
	{
		$command = "SELECT username, password FROM users where username = '" . $user . "'";
		$results = mysqli_query($db, $command);
		 
		checkError($db);

		if($results->num_rows === 0)
		{
			return false;
		}
		else
		{
			$hash = hash("sha512", $pass);
			$row = mysqli_fetch_assoc($results);
			if($hash === $row['password'])
				return true;
			else
				return false;
		}		
	}
	
	function getUserId($db, $user)
	{
		$command = "SELECT userId from users where username='" . $user . "'";
		$results = mysqli_query($db, $command);

		checkError($db);

		if($results->num_rows === 0)
		{
			return NULL;
		}

		$row = mysqli_fetch_assoc($results);

		return $row['userId'];
	}
	
	function getTasksByUserId($db, $user){
		$id = getUserId($db, $user);
		
		$command = "SELECT * from tasks where userId='" . $id . "'";
		$results = mysqli_query($db, $command);
		
		checkError($db);
		
		if($results->num_rows === 0)
		{
			return NULL;
		}
		else
		{
			$tasks = array();
			
			while($row = mysqli_fetch_assoc($results)) {							
				$minutes = "";
				if($row["minutes"] == 00 || $row["minutes"] == 0)
					$minutes = "00";
				else
					$minutes = $row["minutes"];
				
				$dueDate = $row["month"] . "/" . $row["day"] . "/" . $row["year"];
				$currentDate = $_COOKIE["date"];
				$daysLeft = findDaysLeft($dueDate, $currentDate);
				$x = explode(" ", $daysLeft);
				
				$daysToDisplay = $daysLeft;
				if($daysLeft == 0)
					$daysToDisplay = "Due Today";
				else if($daysLeft < 0)
					$daysToDisplay = "LATE";
				
				$task = "<div class=\"task\" id=\"" . $row["taskId"] . "\">
						<p class=\"name\">" . $row["taskname"] . "</p>
						<p class=\"days-left\" id=\"" . $x[0]. "\">" . $daysToDisplay . "</p>
						<p class=\"due-date\">Due " . $dueDate . "</p>
						<p class=\"due-time\">at " . $row["hours"] . ":" . $minutes . " " . $row["ampm"] . "</p>
						<a href=\"removeTask.php?id=" . $row["taskId"] . "\"><div class=\"delete-task\">Remove Task</div></a>
					</div>";
				
				$index = 1;
				
				if(empty($tasks[$x[0]]))
					$tasks[$x[0]] = $task;
				else{
					$tasks[$x[0] . ":" . $index] = $task;
					$index++;
				}
			}
			
			ksort($tasks);
						
			foreach ($tasks as $key => $val) {
				echo $val;
			}
		}
	}
	
	function addTask($db, $user, $name, $day, $month, $year, $hours, $minutes, $ampm){
		$id = getUserId($db, $user);

		$min;
		if($minutes == 00 || $minutes == 0)
			$min = "";
		else
			$min = $minutes;

		$command = "INSERT INTO tasks (taskname, day, month, year, hours, minutes, seconds, ampm, userId) 
			VALUES ('" . $name . "', '" . $day . "', '" . $month . "', '" . $year . "', '" . $hours . "', '" . $min . "', '" . 00 . "', '" . $ampm . "', '" . $id . "')";
		$results = mysqli_query($db, $command);

		checkError($db);
	}

	function removeTask($db, $taskId){
		$command = "DELETE FROM tasks where taskId=\"" . $taskId . "\"";
		$results = mysqli_query($db, $command);

		checkError($db);
	}
	
	function findDaysLeft($dueDate, $currentDate){
		$dueDateParts = explode("/", $dueDate); //mm/dd/yyyy
		$currentDateParts = explode("/", $currentDate); //mm/dd/yyyy
		$days = 0;
		
		//If due month is equal to current month
		if($dueDateParts[0] == $currentDateParts[0])
		{
			//If due date is greater than current date
			if($dueDateParts[1] > $currentDateParts[1])			
				$days = $dueDateParts[1] - $currentDateParts[1] . " days left";		
			else if($dueDateParts[1] < $currentDateParts[1]) //Overdue
				$days = $dueDateParts[1] - $currentDateParts[1];
			else //Due today
				$days = "0";
		}
		else if($dueDateParts[0] > $currentDateParts[0]) //If due month is greater than current month
		{
			$numMonthsLeft = $dueDateParts[0] - $currentDateParts[0];
			$totalDays = getDaysInMonth($currentDateParts[0]) - $currentDateParts[1];
			
			for($i = 1; $i < $numMonthsLeft; $i++)
			{
				$totalDays += getDaysInMonth($currentDateParts[0] + $i);
			}
					
			$totalDays += $dueDateParts[1];
			$days = ($totalDays) . " days left";
		}
		else //If due month is less than current month
			$days = "-1";
		
		return $days;
	}
	
	function getDaysInMonth($monthNum)
	{	
		$days = array(
			"1" => "31",
			"2" => "28",
			"3" => "31",
			"4" => "30",
			"5" => "31",
			"6" => "30",
			"7" => "31",
			"8" => "31",
			"9" => "30",
			"10" => "31",
			"11" => "30",
			"12" => "31"	
		);
		
		return $days[$monthNum];
	}
?>