<?php
	header('Content-Type', 'application/json');
	// Include this at the start of every PHP file to ensure the session is started
	if(!isset($_SESSION))
	{
		session_start();
	}
	
	// Variables are created and made empty
	$username = $password = "";
	$isStaff = 0;
	$loggedIn = true;
	
	// Not sure if all variables will be needed just yet
	// But they are preped just in case
	$serverResponse = [];
	$serverResponse["usrname"] = NULL;
	$serverResponse["isStaff"] = NULL;
	$serverResponse["loggedIn"] = NULL;
	$serverResponse["success"] = true;
	
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
		// Creates a session for a user if they have logged in
		$_SESSION['user'] = array (
			'username' => $username,
			'staff' => $isStaff,
			'loggedIn' => $loggedIn
		);
					
		//echo "<p id='loginSuccess'>User " . $_SESSION['user']['username'] . " has logged in!</p>";
		$serverResponse["usrname"] = $_SESSION['user']['username'];
		$serverResponse["isStaff"] = $_SESSION['user']['staff'];
		$serverResponse["loggedIn"] = $_SESSION['user']['loggedIn'];
		$serverResponse["success"] = true;
	}
		
	// Sends the results back to the client
	// Should only be one echo in the script
	// This is the end of the script
	echo json_encode($serverResponse);
			
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
        $conn = new mysqli($host, $user, $passwd, $dbname);

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
					$query = "SELECT `Username`, `Password` FROM `users`
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
						$query = "SELECT `Staff` FROM `users` WHERE `Username`='$username'
							AND `Password`='$pass'";
						$result = $mysqli->query($query);
						$isStaff = $result->fetch_assoc(); // Should be a 1 or a 0
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