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

		// Checks if there is not enough stock to satisfy order.
		$query = "SELECT `Name`
			FROM `Product` `P`, `Cart` `C`
			WHERE `P`.`ProductID` = `C`.`ProductID`
			AND NOT (`P`.`Qty` - `C`.`Qty`) >= 0
			AND `Username` = '$username';";
		$result = $mysqli->query($query);

		// If there is enough stock.
		if (mysqli_num_rows($result) == 0)
		{
			// Subtracts order quantity from stock quantity.
			$query = "UPDATE `Product` `P`, `Cart` `C`
				SET `P`.`Qty` = `P`.`Qty` - `C`.`Qty`
				WHERE `P`.`ProductID` = `C`.`ProductID` AND `Username` = '$username';";
			$mysqli->query($query);

			// Clears cart.
			$query = "DELETE
				FROM `Cart`
				WHERE `Username` = '$username';";
			$mysqli->query($query);

			echo json_encode("success");
		}

		else
		{
			// Returns names of all products that could not be satisfied.
			$tmpArr = array();
			while (($row = $result->fetch_assoc()))
			{
				array_push($tmpArr, $row);
			}

			echo json_encode($tmpArr);
		}

		$mysqli->close();
	}
?>
