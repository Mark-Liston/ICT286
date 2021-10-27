<?php
    if (!isset($_SESSION))
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

    function getUser()
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
            $query = "SELECT * FROM `Users` WHERE `Username`='$username'";
            $result = $mysqli->query($query);
            $row = $result->fetch_assoc();
            $mysqli->close();
            return $row;
        }
    }

    $username = $password = "";
	$name = $address = $city = $state = $country =
        $postcode = $phone = $email = NULL;
	$isStaff = NULL;
	$loggedIn = true;

    $serverResponse = array();

    $serverResponse = getUser();

    echo json_encode($serverResponse);
?>