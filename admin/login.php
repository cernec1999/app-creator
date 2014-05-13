<?php
	/*
	*  Application Creator
	*  Created By Chris Cerne
	*  Copyright (C) 2014 Chris Cerne All Rights Reserved
	*/
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>Login</title>
		<link href="../ext/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<style type = "text/css">
			body {
				padding-top: 40px;
				padding-bottom: 40px;
				background-color: #eee;
			}

			.form-signin {
				max-width: 330px;
				padding: 15px;
				margin: 0 auto;
			}
			.form-signin .form-signin-heading,
			.form-signin .checkbox {
				margin-bottom: 10px;
			}
			.form-signin .checkbox {
				font-weight: normal;
			}
			.form-signin .form-control {
				position: relative;
				height: auto;
				-webkit-box-sizing: border-box;
				-moz-box-sizing: border-box;
				box-sizing: border-box;
				padding: 10px;
				font-size: 16px;
			}
			.form-signin .form-control:focus {
				z-index: 2;
			}
			.form-signin input[type="email"] {
				margin-bottom: -1px;
				border-bottom-right-radius: 0;
				border-bottom-left-radius: 0;
			}
			.form-signin input[type="password"] {
				margin-bottom: 10px;
				border-top-left-radius: 0;
				border-top-right-radius: 0;
			}
		</style>
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<div class="container">
			<form class="form-signin" role="form" method = "post" action = "loginsubmit.php">
				<h2 class="form-signin-heading">Administrative Login</h2>
				<input type="password" class="form-control" placeholder="Password" name = "password" required>
				<button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
				<div id = "err">
					<?php
						//Display error if one occurs
						if(isset($_GET['err'])) {
							echo "<font color = \"red\">Error: " . $_GET['err'] . "</font>";
						}
					?>
				</div>
			</form>
		</div>
		<script src="../ext/jquery.js"></script>
		<script src="../ext/bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>