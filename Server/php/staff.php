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

    function getUsers()
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
            $query = "SELECT * FROM `Users`";
            $result = $mysqli->query($query);

            if ($result->num_rows > 0)
            {
                $tmpArr = array();
                while ($row = $result->fetch_assoc())
                {
                    array_push($tmpArr, $row);
                }

                $mysqli->close();
                return $tmpArr;         
            }
        }
        
    }

    $username = $password = "";
	$name = $address = $city = $state = $country =
        $postcode = $phone = $email = NULL;
	$isStaff = NULL;
	$loggedIn = true;
	$row = NULL;

    $serverResponse = array();

    if (isset($_GET["getUsers"]))
    {
        $serverResponse = getUsers();
    }

    echo json_encode($serverResponse);
?>