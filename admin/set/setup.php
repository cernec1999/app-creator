<?php
	/*
	*  Application Creator
	*  Created By Chris Cerne
	*  Copyright (C) 2014 Chris Cerne All Rights Reserved
	*/
	require("../checkcookie.php");
	require ("../../includes.php");
	$config = include '../../config.php';
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>Management</title>
		<link href="../../ext/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="../dashboard.css" rel="stylesheet">
		<link href="setup.css" rel="stylesheet">
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="#">Management</a>
				</div>
			</div>
		</div>
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-3 col-md-2 sidebar">
					<ul class="nav nav-sidebar">
						<li><a href="../index.php">Statistics</a></li>
						<li><a href="../cat/unread.php">Unread Applications</a></li>
						<li><a href="../cat/excellent.php">Excellent Applications</a></li>
						<li><a href="../cat/okay.php">Okay Applications</a></li>
						<li><a href="../cat/trash.php">Trash Can</a></li>
					</ul>
					<ul class="nav nav-sidebar">
						<li><a href="create.php">Build Application</a></li>
						<li class="active"><a href="setup.php">Configuration</a></li>
						<li><a href="appsettings.php">Application Settings</a></li>
						<li><a href="../logout.php">Logout</a></li>
					</ul>
				</div>
				<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
					<h1 class="page-header">Configuration</h1>
					<form role="form" action = "" method = "post" id = "mysql" onsubmit = "return submitForm();" autocomplete="off">
						<div class = "form-signin">
							<h2 class="form-signin-heading">MySQL Configuration</h2>
							<input type="text" class="form-control" placeholder="MySQL Host" id = "host" name = "host" value = "<?php echo $config['mysql_server']; ?>" required autofocus>
							<input type="text" class="form-control" placeholder="MySQL Database" id = "db" name = "db" value = "<?php echo $config['mysql_database']; ?>" required>
							<input type="text" class="form-control" placeholder="MySQL Table Name" id = "table" name = "table" value = "<?php echo explode("_", $config['mysql_table'])[0]; ?>" required>
							<input type="text" class="form-control" placeholder="MySQL Username" id = "uname" name = "uname" value = "<?php echo $config['mysql_username']; ?>" required>
							<input type="password" class="form-control" placeholder="MySQL Password" id = "pwd" name = "pwd" value = "">
						</div>
						<div class = "form-signin">
							<h2 class="form-signin-heading">Site Configuration</h2>
							<input type="password" class="form-control" placeholder="Administrator Password" id = "admin_pwd" name = "admin_pwd" value = "" required>
							<button class="btn btn-lg btn-primary btn-block" type="submit">Save</button>
							<div id = "err"></div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<script src="../../ext/bootstrap/js/bootstrap.min.js"></script>
		<script src="../../ext/jquery.js"></script>
		<script type = "text/javascript">
			function submitForm() {
				$.ajax({type:'POST', url: 'setupsub.php', data:$('#mysql').serialize(), success: function(response) {
					$('#err').html(response);
				}});

				return false;
			}
		</script>
	</body>
</html>
