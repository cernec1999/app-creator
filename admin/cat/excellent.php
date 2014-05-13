<?php
	/*
	*  Application Creator
	*  Created By Chris Cerne
	*  Copyright (C) 2014 Chris Cerne All Rights Reserved
	*/
	require("../checkcookie.php");
	require ("../../includes.php");
	$config = include '../../config.php';
	if(!mysqli_num_rows(mysqli_query($con, "SHOW TABLES LIKE '" . $config['mysql_table'] . "'"))==1) header("Location: ../set/create.php");
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
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">Management</a>

				</div>
			</div>
		</div>
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-3 col-md-2 sidebar">
					<ul class="nav nav-sidebar">
						<li><a href="../index.php">Statistics</a></li>
						<li><a href="unread.php">Unread Applications</a></li>
						<li class = "active"><a href="excellent.php">Excellent Applications</a></li>
						<li><a href="okay.php">Okay Applications</a></li>
						<li><a href="trash.php">Trash Can</a></li>
					</ul>
					<ul class="nav nav-sidebar">
						<li><a href="../set/create.php">Build Application</a></li>
						<li><a href="../set/setup.php">Configuration</a></li>
						<li><a href="../set/appsettings.php">Application Settings</a></li>
						<li><a href="../logout.php">Logout</a></li>
					</ul>
				</div>
				<div class="col-sm-3 col-md-2 sidebar" style="left: auto; right: 0px">
					<ul class="nav nav-sidebar">
						<?php
							$col1 = mysqli_query($con, "SELECT * FROM " . $config['mysql_table'] . " WHERE category = 'Excellent Apps' ORDER BY id ASC");
							while($row1 = mysqli_fetch_array($col1)) {
								if(isset($_GET['id']) && $_GET['id'] == $row1['id']) {
									echo "<li class = \"active\"><a href=\"excellent.php?id=" . $row1['id'] . "\">" . $row1['q1'] . "</a></li>\n";
								} else {
									echo "<li><a href=\"excellent.php?id=" . $row1['id'] . "\">" . $row1['q1'] . "</a></li>\n";
								}
							}
						?>
					</ul>
				</div>
				<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
					<h1 class="page-header">Excellent Applications</h1>
					<?php
						if(isset($_GET['id'])) {
					?>
					<div style = "width: 60%; position: relative;">
						<?php
							$id = mysqli_real_escape_string($con, $_GET['id']);
							$result = mysqli_query($con, "SELECT * FROM " . $config['mysql_table'] . " WHERE id='$id'");
							if ($result) {
								$rows = mysqli_fetch_assoc($result);
							}
							echo "<div id=\"formBody\">";
							$num = 0;
							foreach (getAllQuestions() as $q) {
								$num++;
								echo "<label>" .  $q . "</label>\n";
								echo "<p>" . $rows['q' . $num] . "</p><br />\n";
							}
							$num = null;
							echo "<label>IP Address</label>\n";
							echo "<p>" . $rows['ip'] . "</p>\n";
							echo "</div>\n";
						?>
						<form action = "move.php" method = "get">
							<button type="submit" class="btn btn-default btn-lg" name = "cat" value = "unread">
								<span class="glyphicon glyphicon-envelope"></span> Unread
							</button>
							<button type="button" class="btn btn-default btn-lg active" name = "cat" value = "excellent">
								<span class="glyphicon glyphicon-heart"></span> Excellent
							</button>
							<button type="submit" class="btn btn-default btn-lg"  name = "cat" value = "okay">
								<span class="glyphicon glyphicon-ok"></span> Okay
							</button>
							<button type="submit" class="btn btn-default btn-lg"  name = "cat" value = "trash">
								<span class="glyphicon glyphicon-trash"></span> Trash Can
							</button>
							<input type = "hidden" name = "id" value = "<?php echo $_GET['id']; ?>">
						</form>
					</div>
					<?php
						}
					?>
				</div>
			</div>
		</div>
		<script src="../../ext/jquery.js"></script>
		<script src="../../ext/bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>
