<?php
	/*
	*  Application Creator
	*  Created By Chris Cerne
	*  Copyright (C) 2014 Chris Cerne All Rights Reserved
	*/
	require("../checkcookie.php");
	require ("../../includes.php");
	$config = include '../../config.php';
	if(!isset($_POST['questions'])) {
		echo "No data received.";
		exit;
	}
	$questions = $_POST['questions'];
	if(mysqli_num_rows(mysqli_query($con, "SHOW TABLES LIKE '" . $config['mysql_table_questions'] . "'")) >= 1) {
		mysqli_query($con, "DROP TABLE "  . $config['mysql_table_questions']);
	}
	$sql = "CREATE TABLE " . $config['mysql_table_questions'] . " (id INT(11) AUTO_INCREMENT,question TEXT,category TINYTEXT,type TINYTEXT,extdata MEDIUMTEXT, PRIMARY KEY (id))";
	mysqli_query($con, $sql);
	$sql = "INSERT INTO " . $config['mysql_table_questions'] . " (question, category, type) VALUES";
	for($i = 0; $i < count($questions); $i++) {
		if($i == count($questions) - 1) {
			$sql .= "('" . mysqli_real_escape_string($con, $questions[$i][0]) . "', '" . mysqli_real_escape_string($con, $questions[$i][1]) . "', '" . mysqli_real_escape_string($con, $questions[$i][2]) . "');";
		} else {
			$sql .= "('" . mysqli_real_escape_string($con, $questions[$i][0]) . "', '" . mysqli_real_escape_string($con, $questions[$i][1]) . "', '" . mysqli_real_escape_string($con, $questions[$i][2]) . "'),";
		}
	}
	mysqli_query($con, $sql);
	if(mysqli_num_rows(mysqli_query($con, "SHOW TABLES LIKE '" . $config['mysql_table'] . "'")) >= 1) {
		mysqli_query($con, "DROP TABLE "  . $config['mysql_table']);
	}
	$sql = "CREATE TABLE " . $config['mysql_table'] . " (id INT(11) AUTO_INCREMENT,category MEDIUMTEXT,ip MEDIUMTEXT,";
	for($i = 1; $i <= count($questions); $i++) {
		if($i == count($questions)) {
			$sql .= "q" . $i . " MEDIUMTEXT, PRIMARY KEY (id))";
		} else {
			$sql .= "q" . $i . " MEDIUMTEXT,";
		}
	}
	echo $sql;
	mysqli_query($con, $sql);
?>