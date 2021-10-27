<?php
	if(!isset($_SESSION))
	{
		session_start();
	}

	ini_set("display_errors", "1");
	ini_set("display_startup_errors", "1");
	error_reporting(E_ALL);

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

		// Gets user's cart.
		$query = "SELECT `P`.`ProductID` AS ProductID, `Type`, `Name`, `Price`, `URL`, `P`.`Qty` AS TotalQty,
			`C`.`Qty` AS OrderQty
			FROM `Product` `P`, `Cart` `C`
			WHERE `P`.`ProductID` = `C`.`ProductID` AND `C`.`Username` = '$username';";
		
		$result = $mysqli->query($query);

		$tmpArr = array();
		while (($row = $result->fetch_assoc()))
		{
			array_push($tmpArr, $row);
		}

		echo json_encode($tmpArr);
	}

	$mysqli->close();
?>
