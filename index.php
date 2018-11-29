<html>
	<head>
		<link rel = "stylesheet" type = "text/css" href = "css/login.css"/>
	</head>
	<body class="bg"><br/> <br/> <br/>
<?php
	session_start();
	if(isset($_SESSION['uid'])) {
		 header("Location: home.php"); 
		 exit; 
	}
?>
		<form method = "post" action = "utl\login.php" id="form">
			<table id = "login">
				<tr><td colspan = "2" style = "text-align: center;"><br/></td></tr>
				<tr><td colspan = "2" style = "text-align: center;">Log in</td></tr>
				<tr><td colspan = "2" style = "text-align: center;"><br/></td></tr>
				<tr><td class = "labels">Username:</td><td class = "data"><input type = "text" name = "user" id = "user"/></td></tr>
				<tr><td colspan = "2" style = "text-align: center;"><br/></td></tr>
				<tr><td class = "labels">Password:</td><td class = "data"><input type = "password" name = "pass" id = "pass"/></td></tr>
				<tr><td colspan = "2" style = "text-align: center;"><br/></td></tr>
				<tr><td colspan = "2" style = "height: 80px;"><input type = "submit" value = "Log in" name = "sub" id = "sub"/></td></tr>
				<tr><td colspan = "2" style = "text-align: center;"><br/></td></tr>
			</table>
		</form>
	</body>
</html>