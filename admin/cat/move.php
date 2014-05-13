<?php
	/*
	*  Application Creator
	*  Created By Chris Cerne
	*  Copyright (C) 2014 Chris Cerne All Rights Reserved
	*/
	require("../checkcookie.php");
	require("../../includes.php");
	$config = include '../../config.php';
	if(!mysqli_num_rows(mysqli_query($con, "SHOW TABLES LIKE '" . $config['mysql_table'] . "'"))==1) header("Location: ../set/create.php");
	$id = mysqli_real_escape_string($con, $_GET['id']);
	$cat = mysqli_real_escape_string($con, $_GET['cat']);
	$fullcat = "";
	if($cat == "unread") $fullcat = "Unread Apps";
	else if($cat == "excellent") $fullcat = "Excellent Apps";
	else if($cat == "okay") $fullcat = "Okay Apps";
	else if($cat == "trash") $fullcat = "Trash Can";
	else exit;
	mysqli_query($con, "UPDATE " . $config['mysql_table'] . " SET category='$fullcat' WHERE id='$id'")or die(mysql_error());
	header("Location: $cat.php");
?>