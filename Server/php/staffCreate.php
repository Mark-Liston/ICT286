<?php
    if(!isset($_SESSION))
	{
		session_start();
	}

	function treat_input($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	
	function addUser()
	{
		ini_set("display_errors", "1");
		ini_set("display_startup_errors", "1");
		error_reporting(E_ALL);
		
		global $username, $password, $name,
			$address, $city, $state, $country,
			$postcode, $phone, $email, $isStaff;
		
		
		require "connect.php";
	
		if ($conn)
		{
			$query = "INSERT INTO `Users` VALUES(
				'$username',
				'$password',
				'$name',
				'$address',
				'$city',
				'$state',
				'$country',
				'$postcode',
				'$phone',
				'$email',
				'$isStaff');";
				
			if ($mysqli->query($query) === TRUE)
			{
				$mysqli->close();
				return true;
			}
			else
			{
				$mysqli->close();
				return false;
			}
		}
		$mysqli->close();
		return false;
	}

    $username = NULL;
	$password = NULL;
	$name = NULL;
	$address = NULL;
	$city = NULL;
	$state = NULL;
	$country = NULL;
	$postcode = NULL;
	$phone = NULL;
	$email = NULL;
	$isStaff = NULL;
	
	$username = treat_input($_POST['username']);
	$password = treat_input($_POST['password']);
	$name = treat_input($_POST['name']);
	$address = treat_input($_POST['address']);
	$city = treat_input($_POST['city']);
	$state = treat_input($_POST['state']);
	$country = treat_input($_POST['country']);
	$postcode = treat_input($_POST['postcode']);
	$phone = treat_input($_POST['phone']);
	$email = treat_input($_POST['email']);
	$isStaff = treat_input($_POST['isStaff']);
	
	$serverResponse = [];
	$serverResponse["username"] = $username;
	$serverResponse["isStaff"] = 0;
	$serverResponse["loggedIn"] = true;
	$serverResponse["name"] = $name;
	$serverResponse["address"] = $address;
	$serverResponse["city"] = $city;
	$serverResponse["state"] = $state;
	$serverResponse["country"] = $country;
	$serverResponse["postcode"] = $postcode;
	$serverResponse["phone"] = $phone;
	$serverResponse["email"] = $email;
	$serverResponse["success"] = false;

    if (addUser())
	{
		$serverResponse["success"] = true;
        /*
		$_SESSION['user'] = array (
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
        */

		//setcookie("user", $serverResponse["username"]);
	}
	else
	{
		
		$serverResponse["username"] = NULL;
		$serverResponse["isStaff"] = NULL;
		$serverResponse["loggedIn"] = NULL;
		$serverResponse["name"] = NULL;
		$serverResponse["address"] = NULL;
		$serverResponse["city"] = NULL;
		$serverResponse["state"] = NULL;
		$serverResponse["country"] = NULL;
		$serverResponse["postcode"] = NULL;
		$serverResponse["phone"] = NULL;
		$serverResponse["email"] = NULL;
		$serverResponse["success"] = false;
	}
	
	echo json_encode($serverResponse);
?>