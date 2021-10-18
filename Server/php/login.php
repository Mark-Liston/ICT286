<?php
	//header('Content-Type', 'application/json');
	// Include this at the start of every PHP file to ensure the session is started
	if(!isset($_SESSION))
	{
		session_start();
	}
	
	// Variables are created and made empty
	$username = $password = "";
	$name = $address = $city = $state = $country = $postcode = $phone = $email = NULL;
	//$isStaff = 0;
	$loggedIn = true;
	$row = NULL;
	
	// Not sure if all variables will be needed just yet
	// But they are preped just in case
	$serverResponse = [];
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
	$serverResponse["success"] = NULL;
	
	// Treating input
	$username = treat_input($_POST['formUsername']);
	$password = treat_input($_POST['formPassword']);
	
	// Commence validation
	if (!validateCredentials($username, $password))
	{
		$serverResponse["success"] = false;
	}
	else
	{
		// Before sending data as JSON, double assign
		// This is because of a strange issue where all $serverResponse
		// variables are set back to null
		$serverResponse["username"] = $_SESSION['user']['username'];
		$serverResponse["isStaff"] = $_SESSION['user']['staff'];
		$serverResponse["loggedIn"] = $_SESSION['user']['loggedIn'];
		$serverResponse["name"] = $_SESSION['user']['name'];
		$serverResponse["address"] = $_SESSION['user']['address'];
		$serverResponse["city"] = $_SESSION['user']['city'];
		$serverResponse["state"] = $_SESSION['user']['state'];
		$serverResponse["country"] = $_SESSION['user']['country'];
		$serverResponse["postcode"] = $_SESSION['user']['postcode'];
		$serverResponse["phone"] = $_SESSION['user']['phone'];
		$serverResponse["email"] = $_SESSION['user']['email'];
		$serverResponse["success"] = true;
	}
	
	// Sends the results back to the client
	// Should only be one echo in the script
	// This is the end of the script
	//######################################################################
	echo json_encode($serverResponse);
	//######################################################################
			
	// Ensure safe input
	function treat_input($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
			
	// Will return true if credentials match, returns false if they are incorrect
	function validateCredentials($username, $pass)
	{
		ini_set("display_errors", "1");
        ini_set("display_startup_errors", "1");
        error_reporting(E_ALL);

		
        $host = "localhost";
        $user = "X33958503";
        $passwd = "X33958503";
        $dbname = "X33958503";

		// Open connection to database
        $mysqli = new mysqli($host, $user, $passwd, $dbname);
		

        // If connection unsuccessful.
        if ($mysqli->connect_errno)
        {
			//echo "Failed to connect to MYSQL: $conn->connect_error
			//	<br/>Error number: $conn->connect_errno";
			$mysqli->close();
			return false;
        }
        else
		{
			// If database selection unsuccessful.
			if (!$mysqli->select_db($dbname))
			{
				//echo "Failed to connect to database: $conn->error
				//	<br/>Error number: $conn->connect_errno";
				$mysqli->close();
				return false;
			}
			else
			{
				if(($username != "") && ($pass != ""))
				{
					// Commence SQL check
					// I don't know about CETO but my local MySQL requires backticks on table names and column
					// names in order to work. It won't register otherwise, feel free to change if it doesn't work
					$query = "SELECT `Username`, `Password` FROM `Users`
						WHERE `Username`='$username' AND `Password`='$pass'";
					$result = $mysqli->query($query);
					// See if user exists
					//$userFound = $conn->num_rows($query);
							
					//if ($userFound < 1)
					if (mysqli_num_rows($result)==0)
					{
						$mysqli->close();
						return false;
					}
					else
					{
						// I don't know about CETO but my local MySQL requires backticks on table names and column
						// names in order to work. It won't register otherwise, feel free to change if it doesn't work
						// Will always be unique as usernames are unique
						$query = "SELECT * FROM `Users` WHERE `Username`='$username'
							AND `Password`='$pass'";
						$result = $mysqli->query($query);
						$row = $result->fetch_assoc(); // Fetch as associative array
						
						// Assigns values
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
						
						// Create session item with user data
						if (!isset($_SESSION['user']))
						{
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
						
						$mysqli->close();
						return true;
					}
					return false;
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
	
	
?>
