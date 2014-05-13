<?php
	/*
	*  Application Creator
	*  Created By Chris Cerne
	*  Copyright (C) 2014 Chris Cerne All Rights Reserved
	*
	*  Important: Do not edit this configuration file, unless you know what you are doing.
	*/
	$config = include dirname(__FILE__) . '/config.php';
	$con = mysqli_connect($config['mysql_server'], $config['mysql_username'], $config['mysql_password'], $config['mysql_database']);	
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		exit;
	}
	
	function getQuestionNum() {
		//Get Statistics
		global $config;
		global $con;
		return mysqli_num_rows(mysqli_query($con, "SELECT * FROM " . $config['mysql_table_questions'] . " ORDER BY id ASC"));
	}
	function getHeaders() {
		//Get all the headers
		global $config;
		global $con;
		$result = mysqli_query($con, "SELECT category FROM " . $config['mysql_table_questions'] . " ORDER BY id ASC");
		$arr = array();
		while($row = mysqli_fetch_array($result)){
			$arr[] = $row['category'];
		}
		return array_unique($arr);
	}
	function getQuestions($heading) {
		//Get questions pertaining to a heading
		global $config;
		global $con;
		$result = mysqli_query($con, "SELECT question FROM " . $config['mysql_table_questions'] . " WHERE category = '" . mysqli_real_escape_string($con, $heading) . "' ORDER BY id ASC");
		$arr = array();
		while($row = mysqli_fetch_array($result)){
			$arr[] = $row['question'];
		}
		return $arr;
	}
	function getAllQuestions() {
		global $config;
		global $con;
		$result = mysqli_query($con, "SELECT question FROM " . $config['mysql_table_questions'] . " ORDER BY id ASC");
		$arr = array();
		while($row = mysqli_fetch_array($result)){
			$arr[] = $row['question'];
		}
		return $arr;
	}
	function getCat($question) {
		//Get questions pertaining to a heading
		global $config;
		global $con;
		$result = mysqli_query($con, "SELECT type FROM " . $config['mysql_table_questions'] . " WHERE question = '" . mysqli_real_escape_string($con, $question) . "' ORDER BY id ASC");
		$arr = array();
		while($row = mysqli_fetch_array($result)){
			$arr[] = $row['type'];
		}
		return $arr;
	}
	function getRow($cat) {
		global $config;
		global $con;
		return mysqli_fetch_array($con, mysqli_query($con, "SELECT * FROM " . $config['mysql_table'] . " WHERE category = '" . $cat . "' ORDER BY id ASC"));
	}
?>