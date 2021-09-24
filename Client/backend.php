<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
	<head>
		<meta charset="utf-8"/>
		<title>Assignment 2</title>
		<link rel="stylesheet" href="css/index.css"/>
	</head>

	<body>
		<header>
			<a href="index.html"><img src="img/ICT286_Ass2_Temp_Logo.png" alt="Temporary Logo"/></a>

			<nav>
				<a class="active" href="index.html">Home</a>
				<a href="page1.html">Page 1</a>
				<a href="page2.html">Page 2</a>
				<a href="page3.html">Page 3</a>
			

			<div class="searchBar">
				<form action="">
				  <input type="text" placeholder="Search..." name="search">
				  <button type="submit"><i class="fa fa-search">Q</i></button>
				</form>
			</div>
			</nav>
		</header>

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
					if (isset($_GET["dispProducts"]))
					{
						$query = "Select *
							FROM Product;";
						$result = $mysqli->query($query);

						echo "<h1>Products</h1>
						<table>
							<tr>
								<th>Type</th>
								<th>Name</th>
								<th>Price</th>
								<th>Image</th>
							</tr>";

						while ($row = $result->fetch_assoc())
						{
							echo "<tr>
								<td>$row[Type]</td>
								<td>$row[Name]</td>
								<td>$row[Price]</td>
								<td><img src='$row[URL]'/></td>
							</tr>";
						}

						echo "</table>";
					}
				}
			}

			$mysqli->close();
		?>

		</main>
		<footer>
			Footer
		</footer>
	</body>
</html>
