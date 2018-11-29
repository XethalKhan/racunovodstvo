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
		&nbsp;>&nbsp;<a href="assignments.php" class="navlink">Zadaci</a>
	</div>
<?php	
	try{
			$statement = $db->connection->prepare("SELECT id AS id, text AS text FROM `text` WHERE id NOT IN (SELECT DISTINCT ida FROM `completed` WHERE ids = :uid);");
			$statement->bindParam(":uid", $_SESSION['uid']);
			$statement->execute();
			$cnt = $statement->rowCount();
			if($cnt > 0){
				echo "<table style='background-color:red;'>";
				for($i = 0; $i < $cnt; $i++){
					$result = $statement->fetch();
					echo "<tr style='color:red;'>".
							"<td><a href=\"quest.php?id=".$result->id."\">".$result->text."</a></td>".
						 "</tr>";
				}
				echo "</table>";
			}
			else{
				echo "<h1>URADILI STE SVE ZADATKE! SVAKA CAST :)</h1>";
			}
	}
	catch(Exception $e){
		echo $e->getMessage();
	}
?>