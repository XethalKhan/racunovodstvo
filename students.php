<html>
	<head>
		<link rel = "stylesheet" type = "text/css" href = "css/home.css"/>
		<link rel = "stylesheet" type = "text/css" href = "css/nav.css"/>
	</head>
	<body class="bg"><br/> <br/> <br/>
<?php
	require_once("utl/redirect.php");

	require_once('utl/db.php');
	
	require_once("nav.php");
?>
	<div id="jump">
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="home.php" class="navlink">Glavna</a>
		&nbsp;>&nbsp;<a href="students.php" class="navlink">Studenti</a>
	</div>
<?php
	try{
		$statement = $db->connection->prepare("SELECT id AS id, username AS username, grp AS grp FROM `user` WHERE grp = 1;");
		$statement->execute();
		$cnt = $statement->rowCount();
		if($cnt > 0){
			echo "<table style='background-color:red;'>";
			for($i = 0; $i < $cnt; $i++){
				$result = $statement->fetch();
				echo "<tr style='color:red;'>".
						"<td><a href=\"mygrades.php?id=".$result->id."\">".$result->username."</a></td>".
					 "</tr>";
			}
			echo "</table>";
		}
		else{
			echo "<h1>NIKO NE KORISTI OVAJ SERVIS :(</h1>";
		}
	}
	catch(Exception $e){
		echo $e->getMessage();
	}
?>