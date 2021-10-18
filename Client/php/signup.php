<?php
	// Setup
	//##################################################################
	// Include this at the start of every PHP file to ensure the session is started
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
			$postcode, $phone, $email;
		
		
    	$host = "localhost";
    	$user = "X33958503";
    	$passwd = "X33958503";
    	$dbname = "X33958503";

		// Open connection to database
    	$mysqli = new mysqli($host, $user, $passwd, $dbname);
	
		if ($mysqli->connect_errno)
		{
			$mysqli->close();
			return false;
		}
		else
		{
			if (!$mysqli->select_db($dbname))
			{
				$mysqli->close();
				return false;
			}
			else
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
					0)";
				
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
		}
		$mysqli->close();
		return false;
	}
	
	//##################################################################
	// code execution
	
	// Initialise values to null
	// These will be global values
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
	
	$username = treat_input($_POST['usernameInputSignup']);
	$password = treat_input($_POST['passwordInputSignup']);
	$name = treat_input($_POST['nameInputSignup']);
	$address = treat_input($_POST['addressInputSignup']);
	$city = treat_input($_POST['cityInputSignup']);
	$state = treat_input($_POST['stateInputSignup']);
	$country = treat_input($_POST['countryInputSignup']);
	$postcode = treat_input($_POST['postcodeInputSignup']);
	$phone = treat_input($_POST['phoneInputSignup']);
	$email = treat_input($_POST['emailInputSignup']);
	
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