<?php
	if(!isset($_SESSION))
	{
		session_start();
	}

	ini_set("display_errors", "1");
	ini_set("display_startup_errors", "1");
	error_reporting(E_ALL);

	$searchVal = treat_input($_POST["searchVal"]);

	require "connect.php";
	if ($conn)
	{
		$query = "SELECT *
			FROM Product
			WHERE Name LIKE '%$searchVal%' OR Type LIKE '%$searchVal%';";
		$result = $mysqli->query($query);

		$tmpArr = array();
		while (($row = $result->fetch_assoc()))
		{
			array_push($tmpArr, $row);
		}

		echo json_encode($tmpArr);
	}
	
	$mysqli->close();

	// Ensure safe input
	function treat_input($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
?>
