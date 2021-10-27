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

function getproducts()
{
    ini_set("display_errors", "1");
    ini_set("display_startup_errors", "1");
    error_reporting(E_ALL);

    require "connect.php";

    if ($conn)
    {
        $query = "SELECT * FROM `Product`";
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

$serverResponse = array();

$serverResponse = getproducts();

echo json_encode($serverResponse);
?>
