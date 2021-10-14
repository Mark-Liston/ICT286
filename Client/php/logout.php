<?php
	if (!isset($_SESSION))
	{
		session_start();
	}
	
	$success = null;
	
	if (isset($_GET['logout']))
	{
		// Logging user out of their account/session
		if (isset($_SESSION['user']))
		{
			unset($_SESSION['user']);
			$success = true;
		}
		else
		{
			// Just in case of failure to log user out/user doesn't exist
			$success = false;
		}
		
		echo $success;
	}
?>