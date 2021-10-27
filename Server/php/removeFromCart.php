<?php
	ini_set("display_errors", "1");
        ini_set("display_startup_errors", "1");
        error_reporting(E_ALL);

	if(!isset($_SESSION))
	{
		session_start();
	}

	require "connect.php";
	if ($conn)
	{
		if (isset($_COOKIE["user"]))
		{
			$username = $_COOKIE["user"];
		}

		// Use session ID as username if user is unregistered/not logged in.
		else
		{
			$username = $_COOKIE["PHPSESSID"];
		}

		$productID = $_POST["productID"];

		$query = "DELETE
			FROM `Cart`
			WHERE `Username` = '$username' AND `ProductID` = '$productID';";
		$result = $mysqli->query($query);
		
		echo json_encode($result);
		$mysqli->close();
	}
?>
