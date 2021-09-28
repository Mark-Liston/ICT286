<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
	<head>
		<meta charset="utf-8"/>
		<title>Assignment 2</title>
		<link rel="stylesheet" href="css/index.css"/>
	</head>

	<body>
		<?php include_once('header.php'); ?>

		<main>

		<?php
                	ini_set("display_errors", "1");
                	ini_set("display_startup_errors", "1");
                	error_reporting(E_ALL);

                	$host = "localhost";
                	$user = "X33958503";
                	$passwd = "X33958503";
                	$dbname = "X33958503";

                	$mysqli = new mysqli($host, $user, $passwd, $dbname);

                	// If connection unsuccessful.
                	if ($mysqli->connect_errno)
                	{
				echo "Failed to connect to MYSQL: $mysqli->connect_error
					<br/>Error number: $mysqli->connect_errno";
                	}
		
                	else
			{
				// If database selection unsuccessful.
				if (!$mysqli->select_db($dbname))
				{
					echo "Failed to connect to database: $mysqli->error
						<br/>Error number: $mysqli->connect_errno";
				}

				else
				{
					$i = 0;
					if (isset($_GET["dispProducts"]))
					{
						$query = "Select *
							FROM Product;";
						$result = $mysqli->query($query);

						echo "<div class='productGrid'>";

						while (($row = $result->fetch_assoc()))
						{
							echo "<div class='productGridItem'>
								<div class='productName'>$row[Name]<br/></div>
								<div class='productType'>$row[Type]<br/></div>
								<div class='productPrice'>$$row[Price]<br/></div>
								<img src='$row[URL]'/>
							</div>";
						}

						echo "</div>";
					}
				}
			}

			$mysqli->close();
		?>

		</main>

		<?php include_once('footer.php'); ?>
	</body>
</html>
