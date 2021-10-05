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
			<div class="loginFormContainer">
				<form class="loginForm" action="loginProcess.php" method="POST">
					<div id="loginAlignment">
						<label class="loginLabel"> Username:</label>
						<input type="text" name="username"/><br />
						<label class="loginLabel"> Password:</label>
						<input type="password" name="password"/><br /><br />
				
						<input type="submit" value="Login"/>
					</div>
				</form>
			</div>
		</main>
		<?php include_once('footer.php'); ?>
	</body>
</html>