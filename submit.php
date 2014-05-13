<?php
	/*
	*  Application Creator
	*  Created By Chris Cerne
	*  Copyright (C) 2014 Chris Cerne All Rights Reserved
	*/
	require ("includes.php");
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
		<title>Processing Application</title>
	</head>
	<body>
		<h1><?php echo $config['site_header'] ?></h1>
		<?php
			if(!$_POST) {
				header("Location: index.php");
				exit;
			}
			if(!file_exists("config.php")) {
				header("Location: index.php");
			}
			if(strlen($_POST['q1']) <= 2) {
				echo "<h3>Error: The first question must be at least three characters.</h3>";
				exit;
			}
			$sql = "SELECT * FROM " . $config['mysql_table'] . " WHERE LOWER(q1) = LOWER('" . mysql_real_escape_string($_POST['q1']) . "')";
			$result = mysqli_query($con, $sql);
			$row = mysqli_fetch_assoc($result);
			if(mysqli_num_rows($result)) {
				echo "<h3>Error: Your application has not been submitted because the account '" . $_POST['q1'] . "' has already submitted an application.</h3>\n";
				exit;
			}
			for($i = 1; $i <= getQuestionNum(); $i++) {
				$_POST["q" . $i] = htmlspecialchars(mysqli_real_escape_string($con, $_POST["q" . $i]));
			}
			$ip = $_SERVER['REMOTE_ADDR'];
			$sql_q = "INSERT INTO " . $config['mysql_table'] . " (category, ip, ";
			//Build Query
			for($i = 1; $i <= getQuestionNum(); $i++) {
				if($i == getQuestionNum()) {
					$sql_q .= "q" . $i . ") VALUES (";
				} else {
					$sql_q .= "q" . $i . ", ";
				}
			}
			$sql_q .= "'Unread Apps', '" . $ip . "', ";
			for($i = 1; $i <= getQuestionNum(); $i++) {
				if($i == getQuestionNum()) {
					$sql_q .= "'" . $_POST["q" . $i] . "');";
				} else {
					$sql_q .= "'" . $_POST["q" . $i] . "', ";
				}
			}
			mysqli_query($con, $sql_q);
			echo "<h3>Your form has been submitted to the administration and will be reviewed shortly.</h3>\n";
		?>
	</body>
</html>