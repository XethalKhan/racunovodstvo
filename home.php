<html>
	<head>
		<link rel = "stylesheet" type = "text/css" href = "css/home.css"/>
		<link rel = "stylesheet" type = "text/css" href = "css/nav.css"/>
	</head>
	<body class="bg"><br/> <br/> <br/>
<?php
	require_once("utl/redirect.php");

	require_once("nav.php");
?>	
	<div id="jump">
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="home.php" class="navlink">Glavna</a>
	</div>
<?php
	if($_SESSION['gid']=='1'){
		echo "<table style='background-color:red;'>".
				"<tr style='color:red;'>".
					"<td><a href=\"assignments.php\">Zadaci</a></td>".
				"</tr>".
				"<tr style='color:red;'>".
					"<td><a href=\"mygrades.php?id=".$_SESSION['uid']."\">Ocene</a></td>".
				"</tr>".
			  "</table>";
	}
	
	if($_SESSION['gid']=='2'){
		echo "<table style='background-color:red;'>".
				"<tr style='color:red;'>".
					"<td><a href=\"new.php\">Novi zadatak</a></td>".
				"</tr>".
				"<tr style='color:red;'>".
					"<td><a href=\"grade.php\">Predati zadaci</a></td>".
				"</tr>".
				"<tr style='color:red;'>".
					"<td><a href=\"students.php\">Studenti</a></td>".
				"</tr>".
			  "</table>";
	}
?>
	</body>
</html>