<?php
	/*
	*  Application Creator
	*  Created By Chris Cerne
	*  Copyright (C) 2014 Chris Cerne All Rights Reserved
	*/
	require("../checkcookie.php");
	require ("../../includes.php");
	$cfg = include '../../config.php';
	if(!empty($_POST)) {
		if($_POST['app-off'] == "on") {
			if(file_exists("../../.off")) {
				unlink("../../.off");
			}
		} else if($_POST['app-off'] == "off") {
			if(!file_exists("../../.off")) {
				$fileHandle = fopen("../../.off", "w") or die("Cannot close the applications.");
				fclose($fileHandle);
			}
		}
		$site_header = $_POST['title'];
		$site_color = $_POST['color'];
		$site_font = $_POST['font'];
		$mysql_host = $cfg['mysql_server'];
		$mysql_user = $cfg['mysql_username'];
		$mysql_pwd = $cfg['mysql_password'];
		$mysql_db = $cfg['mysql_database'];
		$mysql_table = $cfg['mysql_table'];
		$mysql_table_questions = $cfg['mysql_table_questions'];
		$admin_password = $cfg['admin_password'];
		$config = array();
		$config['mysql_server'] = $mysql_host;
		$config['mysql_username'] = $mysql_user;
		$config['mysql_password'] = $mysql_pwd;
		$config['mysql_database'] = $mysql_db;
		$config['mysql_table'] = $mysql_table;
		$config['mysql_table_questions'] = $mysql_table_questions;
		$config['site_header'] = $site_header;
		$config['site_color'] = $site_color;
		$config['site_font'] = $site_font;
		$config['admin_password'] = $admin_password;
		file_put_contents('../../config.php', '<?php' . "\r\n" . 'return ' . var_export($config, true) . ';' . "\r\n" . '?>');
		echo "<font color = \"green\">Your settings have been saved.</font>";
	}
?>