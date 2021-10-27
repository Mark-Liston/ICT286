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

		// If product is already in cart, get quantity of the order.
		$query = "SELECT Qty
			FROM `Cart`
			WHERE `Username` = '$username' AND `ProductID` = $productID;";
		$result = $mysqli->query($query);
		$row = $result->fetch_assoc();
		
		// If product isn't already in cart, the quantity of the order is 1.
		$orderQty = 1;
		// Otherwise, the quantity of the order is the existing quantity + 1.
		if ($row != NULL)
		{
			$orderQty = $row["Qty"] + 1;
		}
		
		// Get available quantity of selected product.
		$query = "SELECT Qty
			FROM `Product`
			WHERE `ProductID` = '$productID';";
		$result = $mysqli->query($query);
		$qty = $result->fetch_assoc()["Qty"];

		if (($qty - $orderQty) < 0)
		{
			echo "Not enough stock";
		}

		else
		{
			// Add 1 to quantity if product is already in user's cart.
			if ($row != NULL)
			{
				$query = "UPDATE `Cart`
					SET `Qty` = $orderQty
					WHERE `Username` = '$username' AND `ProductID` = $productID;";
			}

			// Insert new product in cart if not already in user's cart.
			else
			{
				$query = "INSERT INTO `Cart`
					VALUES ('$username', $productID, $orderQty, CURDATE());";
			}
			
			$mysqli->query($query);
		}

		// Deletes any elements more than a week old.
		$query = "DELETE FROM `Cart` WHERE `DateAdded` < CURDATE() + 7;";
		$mysqli->query($query);

		$mysqli->close();
	}
?>
