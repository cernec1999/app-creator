<?php
	/*
	*  Application Creator
	*  Created By Chris Cerne
	*  Copyright (C) 2014 Chris Cerne All Rights Reserved
	*/
	if(!file_exists("config.php")) {
		header("Location: setup/index.php");
	}
	if(!file_exists(".off")) {
		require("includes.php");
		$config = include 'config.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>
			<?php echo $config['site_header']; ?>
		</title>
		<meta http-equiv="content-type" content="text/html; charset=us-ascii" />
		<link rel="stylesheet" type="text/css" href="ext/bootstrap/css/bootstrap.min.css">
		<style type = "text/css">
			body {
				background-color: <?php echo $config['site_color'] . ""; ?>;
			}

			h1, h3 {
				text-align: center;
				font-family: '<?php echo $config['site_font'] . ""; ?>', sans-serif;
				font-weight: bold;
			}
			label {
				font-family: '<?php echo $config['site_font'] . ""; ?>', sans-serif;
			}
		</style>
	</head>
	<body>
		<div id="page-content">
			<form action="submit.php" class = "form-signin" method="post">
				<div id="inputArea">
					<div class="container">
						<h1 class = "form-signin-heading">
							<?php echo $config['site_header'] . "\n" ?>
						</h1>
						<?php
							$que = 0;
							foreach(getHeaders() as $h) {
								echo "<br />";
								echo "<h3 class = \"form-signin-heading\">" . $h . "</h3>\n";
								foreach(getQuestions($h) as $q) {
									$que++;
									echo "<label>" . $q . "</label>\n";
									$getCatVar = getCat($q);
									if($getCatVar[0] == "smalltext") {
										echo "<input type = \"text\" class = \"form-control\" name = \"q" . $que . "\">\n";
									} else if($getCatVar[0] == "bigtext") {
										echo "<textarea class = \"form-control\" name = \"q" . $que . "\"></textarea>\n";
									}
								}
							}
						?>
						<br />
						<div class="btn-group btn-group-justified">
							<div class="btn-group">
								<button class="btn btn-default btn-lg" type="submit">Submit</button>
							</div>
							<div class="btn-group">
								<button class="btn btn-default btn-lg" type="reset">Reset</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</body>
</html>
<?php
	}
	else {
		require("includes.php");
		$config = include 'config.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<style type = "text/css">
			body {
				background-color: <?php echo $config['site_color'] . ""; ?>;
			}

			h1, h3 {
				text-align: center;
				font-family: '<?php echo $config['site_font'] . ""; ?>', sans-serif;
				font-weight: bold;
			}
		</style>
		<title><?php echo $config['site_header'] ?></title>
	</head>
	<body>
		<div id="login">
			<h1><?php echo $config['site_header'] ?></h1>
			<h3>The application is closed at the moment. Please check back later.</h3>
		</div>
	</body>
</html>
<?php
	}
?>