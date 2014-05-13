<?php
	/*
	*  Application Creator
	*  Created By Chris Cerne
	*  Copyright (C) 2014 Chris Cerne All Rights Reserved
	*/
	require("../checkcookie.php");
	require ("../../includes.php");
	$config = include '../../config.php';
	if(isset($_POST['clearTable'])) {
		if($_POST['clearTable'] == "yes") {
			mysqli_query($con, "TRUNCATE TABLE " . $config['mysql_table']);
			echo "All of the applications have been cleared.";
		}
	} else {
		echo "Invalid request.";
	}
?>