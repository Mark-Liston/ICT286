<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
	<head>
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<title>Assignment 2</title>
		<link rel="stylesheet" href="css/index.css"/>
	</head>

	<body>
		<?php include_once('header.php'); ?>	

		<main>
			<article id="home">
				<h1>Home</h1>
				<h2>Index</h2>
				<p>Index page for Assignment 2</p>
			</article>

			<article id="products" hidden="hidden">
				<?php include_once("backend.php"); ?>
			</article>

			<article id="login" hidden="hidden">
				<?php include_once("login.php"); ?>
			</article>

			<article id="signup" hidden="hidden">
			</article>
		</main>

		<?php include_once('footer.php'); ?>
	</body>
</html>
