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

    function execute()
    {
        ini_set("display_errors", "1");
		ini_set("display_startup_errors", "1");
		error_reporting(E_ALL);
		
		global $username, $password, $isStaff, $name,
			$address, $city, $state, $country,
			$postcode, $phone, $email;
        global $serverResponse;

        require "connect.php";

        // Check if regular account page is the point of activation
        if (isset($_POST['accountPage']))
        {
            $username = treat_input($_POST['accountUsername']);
            $password = treat_input($_POST['accountPassword']);
            $name = treat_input($_POST['accountName']);
            $address = treat_input($_POST['accountAddress']);
            $city = treat_input($_POST['accountCity']);
            $state = treat_input($_POST['accountState']);
            $country = treat_input($_POST['accountCountry']);
            $postcode = treat_input($_POST['accountPostcode']);
            $phone = treat_input($_POST['accountPhone']);
            $email = treat_input($_POST['accountEmail']);
            $isStaff = $_SESSION['user']['staff'];

            $query = "UPDATE `Users` 
                SET `Username`='$username', `Password`='$password',
                `Name`='$name', `Address`='$address', `City`='$city',
                `CountryState`='$state', `Country`='$country', `Postcode`='$postcode',
                `Phone`='$phone', `Email`='$email', `Staff`=$isStaff WHERE `Username`='$username'";
            
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

        if (isset($_GET['fetchAccountDetails']))
        {
            //$username = $_SESSION['user']['username'];
	    $username = $_COOKIE['user'];
	    $query = "SELECT * FROM `Users` WHERE `Username`='$username'";

            $result = $mysqli->query($query);
            if ($result->num_rows > 0)
            {
                $row = $result->fetch_assoc();
                $serverResponse['username'] = $row['Username'];
                $serverResponse['password'] = $row['Password'];
                $serverResponse['name'] = $row['Name'];
                $serverResponse['address'] = $row['Address'];
                $serverResponse['city'] = $row['City'];
                $serverResponse['state'] = $row['CountryState'];
                $serverResponse['country'] = $row['Country'];
                $serverResponse['postcode'] = $row['Postcode'];
                $serverResponse['phone'] = $row['Phone'];
                $serverResponse['email'] = $row['Email'];

                return true;
            }
            $mysqli->close();
            return false;
        }
    }

    // Declare variables
    $username= $password= $isStaff= $name=
		$address= $city= $state= $country=
		$postcode= $phone= $email = NULL;

    $serverResponse = [];
    $serverResponse['success'] = false;

    if (execute())
    {
        $serverResponse['success'] = true;
    }

    echo json_encode($serverResponse);
?>
