<?php
	function checkError($db)
	{
		$exception = mysqli_error($db);

		if(!empty($exception))
		{
			echo $exception;
			die();
		}
	}

	try 
	{
		$connection = new mysqli("mysql1.000webhost.com", "a6982055_main", "slayer123", "a6982055_project");
		return $connection;
	} 
	catch (Exception $e ) {
		echo "Service unavailable";
		echo "Failed to connect to MySQL: " . $mysqli->connect_error;
		die();
	}
?>