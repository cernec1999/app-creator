<?php
	/*
	*  Application Creator
	*  Created By Chris Cerne
	*  Copyright (C) 2014 Chris Cerne All Rights Reserved
	*/
	if(!$_POST) {
		echo "<font color = \"red\">No form data was received.</font>";
		exit;
		
	}

	$mysql_host = $_POST['host'];
	$mysql_user = $_POST['uname'];
	$mysql_pwd = $_POST['pwd'];
	$mysql_db = $_POST['db'];
	$mysql_table = $_POST['table'];
	$title = $_POST['title'];
	$color = $_POST['color'];
	$font = $_POST['font'];
	$admin_pwd = $_POST['admin_pwd'];

	if(file_exists("../config.php")) {
		echo "<font color = \"red\">You cannot edit configuration files.</font>";
		exit;
	}
	$connection = @mysqli_connect($mysql_host, $mysql_user, $mysql_pwd, $mysql_db);

	if(mysqli_connect_errno() == 1045) {
		echo "<font color = \"red\">Access denied. Check your MySQL username and password.</font>";
		exit;
	} else if(mysqli_connect_errno() == 2002) {
		echo "<font color = \"red\">Could not connect to the MySQL server.</font>";
		exit;
	} else if(mysqli_connect_errno() == 1049) {
		echo "<font color = \"red\">Unknown database '" . $mysql_db . "'. Please enter a valid database.</font>";
		exit;
	} else if(mysqli_connect_errno() == 1044) {
		echo "<font color = \"red\">Access denied. Check your MySQL username and password.</font>";
		exit;
	} else if(mysqli_connect_errno()) {
		echo "<font color = \"red\">An unknown error has occurred. Here are the details:</font><br />Error ID: " . mysqli_connect_errno() . "<br />Error message: " . mysqli_connect_error();
		exit;
	} else {
		//All good to go
		$config = array();
		$config['mysql_server'] = $mysql_host;
		$config['mysql_username'] = $mysql_user;
		$config['mysql_password'] = $mysql_pwd;
		$config['mysql_database'] = $mysql_db;
		$config['mysql_table'] = $mysql_table . "_applications";
		$config['mysql_table_questions'] = $mysql_table . "_questions";
		$config['site_header'] = $title;
		$config['site_color'] = $color;
		$config['site_font'] = $font;
		$config['admin_password'] = md5($admin_pwd);
		file_put_contents('../config.php', '<?php' . "\r\n" . 'return ' . var_export($config, true) . ';' . "\r\n" . '?>');
		$off = fopen("../.off", "w");
		fclose($off); 
		echo "<font color = \"green\">Your settings have been saved. <a href = \"../admin/login.php\">Login</a></font>";
	}
?>