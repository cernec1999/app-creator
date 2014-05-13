<?php
	/*
	*  Application Creator
	*  Created By Chris Cerne
	*  Copyright (C) 2014 Chris Cerne All Rights Reserved
	*/
	$config = include '../config.php';
	if(isset($_POST['password'])) {
		if(md5($_POST['password']) == $config['admin_password']) {
			$hour = time() + 3600;
			$pwd = $_POST['password'];
			setcookie($config['mysql_table'] . '_login', md5($pwd), $hour);
			header("Location: index.php");
		} else {
			header("Location: login.php?err=Invalid password");
		}
	} else {
		header("Location: login.php?err=No data received");
	}
?>