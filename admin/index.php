<?php
	/*
	*  Application Creator
	*  Created By Chris Cerne
	*  Copyright (C) 2014 Chris Cerne All Rights Reserved
	*/
	$up = true;
	require("checkcookie.php");
	require ("../includes.php");
	$config = include '../config.php';
	if(!mysqli_num_rows(mysqli_query($con, "SHOW TABLES LIKE '" . $config['mysql_table'] . "'"))==1) header("Location: set/create.php");
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>Management</title>
		<link href="../ext/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="dashboard.css" rel="stylesheet">
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
						<li class="active"><a href="index.php">Statistics</a></li>
						<li><a href="cat/unread.php">Unread Applications</a></li>
						<li><a href="cat/excellent.php">Excellent Applications</a></li>
						<li><a href="cat/okay.php">Okay Applications</a></li>
						<li><a href="cat/trash.php">Trash Can</a></li>
					</ul>
					<ul class="nav nav-sidebar">
						<li><a href="set/create.php">Build Application</a></li>
						<li><a href="set/setup.php">Configuration</a></li>
						<li><a href="set/appsettings.php">Application Settings</a></li>
						<li><a href="logout.php">Logout</a></li>
					</ul>
				</div>
				<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
					<h1 class="page-header">Statistics</h1>
					<div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
				</div>
			</div>
		</div>
		<script src="../ext/jquery.js"></script>
		<script src="../ext/bootstrap/js/bootstrap.min.js"></script>
		<script src="http://code.highcharts.com/highcharts.js"></script>
		<script src="http://code.highcharts.com/modules/exporting.js"></script>
		<?php
			//Get Statistics
			$unread = mysqli_num_rows(mysqli_query($con, "SELECT * FROM " . $config['mysql_table'] . " WHERE category = 'Unread Apps' ORDER BY id ASC"));
			$okay = mysqli_num_rows(mysqli_query($con, "SELECT * FROM " . $config['mysql_table'] . " WHERE category = 'Okay Apps' ORDER BY id ASC"));
			$excellent = mysqli_num_rows(mysqli_query($con, "SELECT * FROM " . $config['mysql_table'] . " WHERE category = 'Excellent Apps' ORDER BY id ASC"));
			$trash = mysqli_num_rows(mysqli_query($con, "SELECT * FROM " . $config['mysql_table'] . " WHERE category = 'Trash Can' ORDER BY id ASC"));
		?>
		<script type = "text/javascript">
			$(function () {
				$('#container').highcharts({
					chart: {
						plotBackgroundColor: null,
						plotBorderWidth: null,
						plotShadow: false
					},
					title: {
						text: 'Applications'
					},
					tooltip: {
						pointFormat: '{point.name}: <b>{point.y}, {point.percentage:.1f}%</b>'
					},
					exporting: {
						enabled: false
					},
					credits: {
						enabled: false
					},
					plotOptions: {
						pie: {
							allowPointSelect: true,
							cursor: 'pointer',
							dataLabels: {
								enabled: true,
								format: '<b>{point.name}</b>: {point.y}',
								style: {
									color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
								}
							}
						}
					},
					series: [{
						type: 'pie',
						name: 'Percentage',
						data: [
							['Unread',   <?php echo $unread; ?>],
							['Excellent', <?php echo $excellent; ?>],
							['Okay',       <?php echo $okay; ?>],
							['Trash Can',    <?php echo $trash; ?>]
						]
					}]
				});
			});
		</script>
	</body>
</html>
