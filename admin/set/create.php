<?php
	/*
	*  Application Creator
	*  Created By Chris Cerne
	*  Copyright (C) 2014 Chris Cerne All Rights Reserved
	*/
	require("../checkcookie.php");
	require ("../../includes.php");
	$config = include '../../config.php';
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>Management</title>
		<link href="../../ext/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="../dashboard.css" rel="stylesheet">
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="#">Management</a>
				</div>
			</div>
		</div>
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-3 col-md-2 sidebar">
					<ul class="nav nav-sidebar">
						<li><a href="../index.php">Statistics</a></li>
						<li><a href="../cat/unread.php">Unread Applications</a></li>
						<li><a href="../cat/excellent.php">Excellent Applications</a></li>
						<li><a href="../cat/okay.php">Okay Applications</a></li>
						<li><a href="../cat/trash.php">Trash Can</a></li>
					</ul>
					<ul class="nav nav-sidebar">
						<li class="active"><a href="create.php">Build Application</a></li>
						<li><a href="setup.php">Configuration</a></li>
						<li><a href="appsettings.php">Application Settings</a></li>
						<li><a href="../logout.php">Logout</a></li>
					</ul>
				</div>
				<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
					<h1 class="page-header">Build Application</h1>
					<p>You must create a new application before using application creator. Creating a new application will remove all other applications, and will remove all previous questions too, if any are present. The first question will be used as an account identifier. <strong>Remember that you must turn on the application under the 'Application Settings' tab on the left in order for people to use the application.</strong></p>
					<div class="form-inline">
						<div class="btn-group">
							<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
								Add Question <span class="caret"></span>
							</button>
							<ul class="dropdown-menu" role="menu">
								<li><a onClick="addTextBoxQuestion()">Text Box</a></li>
								<li><a onClick="addTextAreaQuestion()">Text Area</a></li>
							</ul>
						</div>
						<button type = "button" class = "btn btn-default" onclick = "addTextBox()" id = "btn">Add Category</button>
						<button type = "button" class = "btn btn-default" onclick = "postQuestionData()" id = "btn">Submit Questions</button>
					</div>
					<br /><br />
					<table class = "table table-striped" id = "questionTable">
						<tr>
							<td>Question</td>
							<td style = "width: 250px;">Category</td>
							<td>Type</td>
							<td>Remove</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
		<script src="../../ext/jquery.js"></script>
		<script src="../../ext/bootstrap/js/bootstrap.min.js"></script>
		<script type = "text/javascript">
			var pressed = false;
			var elements;
			var headings = [];
			var allQuestions = [];
			var num = 1;
			var lbl = 1;
			function addTextBox() {
				if(!pressed) {
					elements = $("<button type = \"button\" class = \"btn btn-default\" id = \"sub\" onclick = \"addHeading()\">Submit</button>").insertAfter($("<input type = \"text\" id = \"heading\" class = \"form-control\"/>").insertAfter("#btn"));
					pressed = true;
				} else {
					$("#sub").remove();
					$("#heading").remove();
					pressed = false;
				}
			}
			function addHeading() {
				alert("Heading added.");
				if($.inArray($("#heading").val(), headings) == -1) {
					headings.push($("#heading").val());
				}
				$("#sub").remove();
				$("#heading").remove();
				pressed = false;
				for (var i = 1; i <= num; i++) {
					addHeadings(i);
				}
			}
			function addTextBoxQuestion() {
				var table = document.getElementById("questionTable");
				var row = table.insertRow(lbl);
				row.id = "row_" + num;
				var cell2 = row.insertCell(0);
				var cell3 = row.insertCell(1);
				var cell4 = row.insertCell(2);
				var cell5 = row.insertCell(3);
				cell3.style["width"] = "250px";
				cell2.innerHTML = "<input type=\"text\" style=\"background-color:transparent;border:0px solid white; width: 100%;\" id = \"q" + num + "\">";
				cell3.innerHTML = "<select class = \"form-control\" style = \"width: 250px;\" id = \"select_" + num + "\"></select>";
				cell4.innerHTML = "<input type = \"hidden\" value = \"smalltext\" id = \"type_" + num + "\" />Text Box";
				cell5.innerHTML = "<button class = \"btn btn-default\" onclick = \"removeRow(" + num + ")\" id = \"rem_" + num + "\">Remove</button>";
				for (var i = 1; i <= num; i++) {
					addHeadings(i);
				}
				allQuestions.push(num);
				num++;
				lbl++;
			}
			function addTextAreaQuestion() {
				var table = document.getElementById("questionTable");
				var row = table.insertRow(lbl);
				row.id = "row_" + num;
				var cell2 = row.insertCell(0);
				var cell3 = row.insertCell(1);
				var cell4 = row.insertCell(2);
				var cell5 = row.insertCell(3);
				cell3.style["width"] = "250px";
				cell2.innerHTML = "<input type=\"text\" style=\"background-color:transparent;border:0px solid white; width: 100%;\" id = \"q" + num + "\">";
				cell3.innerHTML = "<select class = \"form-control\" style = \"width: 250px;\" id = \"select_" + num + "\"></select>";
				cell4.innerHTML = "<input type = \"hidden\" value = \"bigtext\" id = \"type_" + num + "\" />Text Area";
				cell5.innerHTML = "<button class = \"btn btn-default\" onclick = \"removeRow(" + num + ")\" id = \"rem_" + num + "\">Remove</button>";
				for (var i = 1; i <= num; i++) {
					addHeadings(i);
				}
				allQuestions.push(num);
				num++;
				lbl++;
			}
			function addHeadings(id) {
				//Get cell
				var select = document.getElementById("select_" + id);
				if(select != null) {
					var selectedOption = select.selectedIndex;
					select.innerHTML = "";
					var arrayLength = headings.length;
					for(var i = 0; i < arrayLength; i++) {
						var option = document.createElement("option");
						select.appendChild(option);
						option.innerHTML = headings[i];
					}
					select.selectedIndex = selectedOption;
					if(selectedOption == -1) select.selectedIndex = 0;
				}
			}
			function removeRow(id) {
				var index = getIndex(document.getElementById("row_" + (id - 1)));
				document.getElementById("questionTable").deleteRow(index);
				if (allQuestions.indexOf(id -1) > -1)
					allQuestions.splice(allQuestions.indexOf(id), 1);
				lbl--;
			}
			function getIndex(node) {
				var n = 0;
				
				if(node == null) return 1;
				while (node = node.previousSibling)
					n++;

				return n;
			}
			function postQuestionData() {
				if(!confirm('Are you sure you want to submit? Doing so will remove all other applications and questions, and create the new form.')) return false;
				//create multidimensional array from all of the elements
				var multiArr = [];
				for(var i = 0; i < allQuestions.length; i++) {
					//Add question, category, and type
					var que = document.getElementById("q" + allQuestions[i]).value;
					var cat = document.getElementById("select_" + allQuestions[i]).value;
					var type = document.getElementById("type_" + allQuestions[i]).value;
					multiArr.push([que, cat, type]);
				}
				$.ajax({        
					type: "POST",
					url: "createsub.php",
					data: { questions : multiArr },
					success: function() {
						alert("Your changes have been applied.");
					}
				}); 
			}
		</script>
	</body>
</html>