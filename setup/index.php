<?php
	/*
	*  Application Creator
	*  Created By Chris Cerne
	*  Copyright (C) 2014 Chris Cerne All Rights Reserved
	*/
	if(!file_exists("../config.php")) {
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Configuration</title>
		<link href="../ext/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="setup.css" rel="stylesheet">
	</head>
	<body>
		<div class="container">
			<form role="form" action = "" method = "post" id = "mysql" onsubmit = "return submitForm();" autocomplete="off">
				<div class = "form-signin">
					<h2 class="form-signin-heading">MySQL Configuration</h2>
					<input type="text" class="form-control" placeholder="MySQL Host" id = "host" name = "host" required autofocus>
					<input type="text" class="form-control" placeholder="MySQL Database" id = "db" name = "db" required>
					<input type="text" class="form-control" placeholder="MySQL Table Name" id = "table" name = "table" required>
					<input type="text" class="form-control" placeholder="MySQL Username" id = "uname" name = "uname" required>
					<input type="password" class="form-control" placeholder="MySQL Password" id = "pwd" name = "pwd">
				</div>
				<div class = "form-signin">
					<h2 class="form-signin-heading">Site Configuration</h2>
					<input type="text" class="form-control" placeholder="Website Name" id = "title" name = "title" required>
					<input type="text" class="form-control" placeholder="Website Color" id = "color" name = "color" value = "#C2E0FF" style = "background-color: #C2E0FF" required>
					<input type="text" class="form-control" placeholder="Website Font" id = "font" name = "font" value = "Arial" required>
					<input type="password" class="form-control" placeholder="Administrator Password" id = "admin_pwd" name = "admin_pwd" required>
					<button class="btn btn-lg btn-primary btn-block" type="submit">Save</button>
					<div id = "err"></div>
				</div>
				<div id = "err"></div>
			</form>
		</div>
		<script type="text/javascript" src="../ext/jquery.js"></script>
		<script type = "text/javascript">
			$('#color').each(function() {
				var elem = $(this);
				var oldVal = elem.val();
				elem.bind("propertychange keyup input paste", function(event){
					if (oldVal != elem.val()) {
						oldVal = elem.val();
						$('#color').css('background-color', elem.val());
					}
				});
			});
			function submitForm() {
				$.ajax({type:'POST', url: 'sub.php', data:$('#mysql').serialize(), success: function(response) {
					$('#err').html(response);
				}});

				return false;
			}
		</script>
	</body>
</html>
<?php
} else {
	header("Location: ../index.php");
}
?>