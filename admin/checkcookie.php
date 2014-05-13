<?php
	/*
	*  Application Creator
	*  Created By Chris Cerne
	*  Copyright (C) 2014 Chris Cerne All Rights Reserved
	*/
	if(isset($up)) 
		$config = include '../config.php';
	else
		$config = include '../../config.php';
	if(isset($_COOKIE[$config['mysql_table'] . '_login'])) {
		if($_COOKIE[$config['mysql_table'] . '_login'] != $config['admin_password']) {
			if(isset($up)) 
				header("Location: login.php");
			else
				header("Location: ../login.php");
		}
	} else {
		if(isset($up)) 
			header("Location: login.php");
		else
			header("Location: ../login.php");
	}
?>