<?php
	ini_set("display_errors", "1");
        ini_set("display_startup_errors", "1");
        error_reporting(E_ALL);

	if(!isset($_SESSION))
	{
		session_start();
	}

	if (isset($_COOKIE["user"]))
	{
		require "connect.php";
		if ($conn)
		{
			$username = $_COOKIE["user"];
			$query = "SELECT * FROM `Users` WHERE `Username`='$username'";
			$result = $mysqli->query($query);
			$row = $result->fetch_assoc();

			$serverResponse = [];
			$serverResponse["username"] = $row["Username"];
			$serverResponse["isStaff"] = $row["Staff"];
			$serverResponse["loggedIn"] = true;
			$serverResponse["name"] = $row["Name"];
			$serverResponse["address"] = $row["Address"];
			$serverResponse["city"] = $row["City"];
			$serverResponse["state"] = $row["CountryState"];
			$serverResponse["country"] = $row["Country"];
			$serverResponse["postcode"] = $row["Postcode"];
			$serverResponse["phone"] = $row["Phone"];
			$serverResponse["email"] = $row["Email"];


			// Fill session array if user logged in during a different session.
			if (!isset($_SESSION['user']))
			{
				$_SESSION['user'] = array
				(
					'username' => $serverResponse["username"],
					'staff' => $serverResponse["isStaff"],
					'loggedIn' => $serverResponse["loggedIn"],
					'name' => $serverResponse["name"],
					'address' => $serverResponse["address"],
					'city' => $serverResponse["city"],
					'state' => $serverResponse["state"],
					'country' => $serverResponse["country"],
					'postcode' => $serverResponse["postcode"],
					'phone' => $serverResponse["phone"],
					'email' => $serverResponse["email"]
				);

			}

			echo json_encode($serverResponse);

			$mysqli->close();
			
		}
	}

	else
	{
		$output = array('loggedIn'=>false);
		echo json_encode($output);
	}
?>
