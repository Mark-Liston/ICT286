<?php
	$host = "localhost";
	$user = "X33958503";
	$passwd = "X33958503";
	$dbname = "X33958503";

	$mysqli = new mysqli($host, $user, $passwd, $dbname);

	$conn = true;

	// If connection unsuccessful.
	if ($mysqli->connect_errno)
	{
		$myslqi->close;
		$conn = false;
	}
	
	else
	{
		// If database selection unsuccessful.
		if (!$mysqli->select_db($dbname))
		{
			$mysqli->close;
			$conn = false;
		}
	}

	if (!$conn)
	{
		$mysqli->close();
	}
?>
