<?php
	/*
	*  Application Creator
	*  Created By Chris Cerne
	*  Copyright (C) 2014 Chris Cerne All Rights Reserved
	*/
	$up = true;
	$config = include '../config.php';
	require("checkcookie.php");
	setcookie($config['mysql_table'] . '_login', "", time() - 3600);
	header("Location: login.php");
?>