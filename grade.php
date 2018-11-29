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
		&nbsp;>&nbsp;<a href="grade.php" class="navlink">Predati zadaci</a>
	</div>
<?php
	try{
		$query = "SELECT DISTINCT u.id AS ids, u.username AS username, a.text AS text, a.id AS ida ".
				 "FROM user AS u ".
				 "JOIN completed AS c ".
					"ON u.id = c.ids ".
				 "JOIN text AS a ".
					"ON a.id = c.ida ".
				 "WHERE ".
					"u.grp = 1 ".
					"AND (u.id, a.id) NOT IN (SELECT g.ids, g.ida FROM grades g)";
		$statement = $db->connection->prepare($query);
		$statement->execute();
		$cnt = $statement->rowCount();
		if($cnt > 0){
			echo "<table style='background-color:red;'>";
			for($i = 0; $i < $cnt; $i++){
				$result = $statement->fetch();
				echo "<tr style='color:red;'>".
						"<td><a href=\"check.php?ids=".$result->ids."&ida=".$result->ida."\"><b>Student:</b> ".$result->username."&nbsp;&nbsp;&nbsp;&nbsp; <b>Zadatak:</b> ".$result->text."</a></td>".
					 "</tr>";
			}
			echo "</table>";
		}
		else{
			echo "<h1>NEMA ZADATAKA ZA PREGLEDANJE</h1>";
		}
	}
	catch(Exception $e){
		echo $e->getMessage();
	}
?>