<?php
	if(!isset($_SESSION))
	{
		session_start();
	}

	ini_set("display_errors", "1");
	ini_set("display_startup_errors", "1");
	error_reporting(E_ALL);


	$host = "localhost";
	$user = "X33958503";
	$passwd = "X33958503";
	$dbname = "X33958503";

	$mysqli = new mysqli($host, $user, $passwd, $dbname);


	// If connection unsuccessful.
	if ($mysqli->connect_errno)
	{
		echo "Failed to connect to MYSQL: $mysqli->connect_error
			<br/>Error number: $mysqli->connect_errno";
	}
	
	else
	{
		// If database selection unsuccessful.
		if (!$mysqli->select_db($dbname))
		{
			echo "Failed to connect to database: $mysqli->error
				<br/>Error number: $mysqli->connect_errno";
		}

		else
		{
			$query = "Select *
				FROM Product;";
			$result = $mysqli->query($query);

			$tmpArr = array();
			while (($row = $result->fetch_assoc()))
			{
				array_push($tmpArr, $row);
			}

			echo json_encode($tmpArr);
		}
	}
	
	$mysqli->close();
?>
