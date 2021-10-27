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

    function updateUser()
    {
        ini_set("display_errors", "1");
		ini_set("display_startup_errors", "1");
		error_reporting(E_ALL);
		
		global $username, $password, $isStaff, $name,
			$address, $city, $state, $country,
			$postcode, $phone, $email;
        global $serverResponse;

        require "connect.php";

        if ($conn)
        {
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
            $isStaff = $_SESSION['user']['staff'];
    
            $query = "UPDATE `Users` 
                SET `Username`='$username', `Password`='$password',
                `Name`='$name', `Address`='$address', `City`='$city',
                `CountryState`='$state', `Country`='$country', `Postcode`='$postcode',
                `Phone`='$phone', `Email`='$email', `Staff`=$isStaff WHERE `Username`='$username'";
                
            $result = $mysqli->query($query);
            $mysqli->close();
            return true;
        }
        else
        {
            $mysqli->close();
            return false;
        }
        
    }

    // Declare variables
    $username= $password= $isStaff= $name=
		$address= $city= $state= $country=
		$postcode= $phone= $email = NULL;

    $serverResponse = [];

    if (updateUser())
    {
        $serverResponse['success'] = true;
    }
    else
    {
        $serverResponse['success'] = false;
    }

    echo json_encode($serverResponse);

?>