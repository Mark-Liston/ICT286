<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
	<head>
		<meta charset="utf-8"/>
		<title>Assignment 2</title>
		<link rel="stylesheet" href="css/index.css"/>
		
	</head>

	<body>
		<main>
			<div class="loginFormContainer">
				<form class="loginForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
					<div id="loginAlignment">
						<label class="loginLabel"> Username:</label>
						<input type="text" name="username"/><br />
						<label class="loginLabel"> Password:</label>
						<input type="password" name="password"/><br /><br />
				
						<input type="submit" value="Login" id="loginButton"/>
					</div>
				</form>
			</div>
		</main>
		
		<?php
			// Variables are created and made empty
			$username = $password = "";
			$isStaff = 0;
			
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				$username = treat_input($_POST['username']);
				$password = treat_input($_POST['password']);
				
				if (!validateCredentials($username, $password))
				{
					echo "<p id='missingLogin'>Invalid username or password</p>";
				}
				else
				{
					$_SESSION['user'] = array (
						'username' => $username,
						'staff' => $isStaff
					);
					
					echo "<p id='loginSuccess'>User " . $_SESSION['user']['username'] . " has logged in!</p>";
				}
			}
			else
			{
				// Do nothing at the moment
			}
			
			// Ensure safe input of self submit php form
			function treat_input($data) {
				$data = trim($data);
				$data = stripslashes($data);
				$data = htmlspecialchars($data);
				return $data;
			}
			
			// Will return true if credentials match, returns false if they are incorrect
			function validateCredentials($username, $pass) {
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
        		if ($conn->connect_errno)
        		{
					echo "Failed to connect to MYSQL: $conn->connect_error
						<br/>Error number: $conn->connect_errno";
					$conn->close();
					return false;
        		}
        		else
				{
					// If database selection unsuccessful.
					if (!$conn->select_db($dbname))
					{
						echo "Failed to connect to database: $conn->error
							<br/>Error number: $conn->connect_errno";
						$conn->close();
						return false;
					}
					else
					{
						if(($username != "") && ($pass != ""))
						{
							// Commence SQL check
							$query = "SELECT 'Username', 'Password' FROM 'users'
								WHERE 'Username'='$username' AND 'Password'='$pass'";
							$result = $conn->query($query);
							// See if user exists
							//$userFound = $conn->num_rows($query);
							
							//if ($userFound < 1)
							if (mysqli_num_rows($result)==0)
							{
								$conn->close();
								return false;
							}
							else
							{
								$query = "SELECT 'Staff' FROM 'users' WHERE 'Username'='$username'
									AND 'Password'='$pass'";
								$result = $conn->query($query);
								$isStaff = $result->fetch_assoc(); // Should be a 1 or a 0
								$conn->close();
								return true;
							}
							return false;
						}
						else
						{
							$conn->close();
							return false;
						}
					}
				}
				$conn->close();
				return false;
			}
		?>
	</body>
</html>
