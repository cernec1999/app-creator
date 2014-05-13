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
						<li><a href="setup.php">Configuration</a></li>
						<li class="active"><a href="appsettings.php">Application Settings</a></li>
						<li><a href="../logout.php">Logout</a></li>
					</ul>
				</div>
				<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
					<h1 class="page-header">Application Settings</h1>
					<form role="form" action = "" method = "post" id = "settings" onsubmit = "return submitForm();" autocomplete="off">
						<div class = "form-signin">
							<h2 class="form-signin-heading">Application Settings</h2>
							<select class = "form-control" id = "app-off" name = "app-off">
								<?php
									if(file_exists("../../.off")) {
										echo "<option value = \"on\">Turn Application On</option>";
										echo "<option value = \"off\" selected>Turn Application Off</option>";
									} else {
										echo "<option value = \"on\" selected>Turn Application On</option>";
										echo "<option value = \"off\">Turn Application Off</option>";
									}
								?>
							</select>
							<input type="text" class="form-control" placeholder="Website Name" id = "title" name = "title" value = "<?php echo $config['site_header']; ?>" required autofocus />
							<input type="text" class="form-control" placeholder="Website Color" id = "color" name = "color" value = "<?php echo $config['site_color']; ?>" style = "background-color: <?php echo $config['site_color']; ?>;" required />
							<input type="text" class="form-control" placeholder="Website Font" id = "font" name = "font" value = "<?php echo $config['site_font']; ?>" required>
							<button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
							<div id = "err"></div>
						</div>
					</form>
					
					<form role="form" action = "" method = "post" id = "clear" onsubmit = "return clearApps();" autocomplete="off">
						<div class = "form-signin">
							<input type = "hidden" name = "clearTable" value = "yes" />
							<button class="btn btn-lg btn-primary btn-block" type="submit">Clear Applications</button>
							<div id = "err2"></div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<script src="../../ext/bootstrap/js/bootstrap.min.js"></script>
		<script src="../../ext/jquery.js"></script>
		<script type = "text/javascript">
			$('#color').each(function() {
				var elem = $(this);
				var oldVal = elem.val();
				elem.bind("propertychange keyup input paste", function(event){
					if (oldVal != elem.val()) {
						oldVal = elem.val();
						$('#color').css('background-color', elem.val());
					}
				});
			});
			function submitForm() {
				if(!confirm('Are you sure you want to change these settings?')) return false;
				$.ajax({type:'POST', url: 'apptoggle.php', data:$('#settings').serialize(), success: function(response) {
					$('#err').html(response);
				}});

				return false;
			}
			function clearApps() {
				if(!confirm('Are you sure you want to clear the applications? All previous responses will be removed, but the questions will remain.')) return false;
				$.ajax({type:'POST', url: 'appclear.php', data:$('#clear').serialize(), success: function(response) {
					$('#err2').html(response);
				}});

				return false;
			}
		</script>
		
	</body>
</html>
