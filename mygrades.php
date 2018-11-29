<html>
	<head>
		<link rel = "stylesheet" type = "text/css" href = "css/home.css"/>
		<link rel = "stylesheet" type = "text/css" href = "css/nav.css"/>
	</head>
	<body style = 'background-image: url("img/img1.jpg");'><br/><br/><br/>
<?php
	require_once("utl/redirect.php");
	
	require_once('utl/db.php');
	
	require_once("nav.php");
	
	if(!empty($_GET)){
	
		if($_SESSION['gid'] == 1){
			echo "<div id=\"jump\">".
					 "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"home.php\" class=\"navlink\">Glavna</a>".
					 "&nbsp;>&nbsp;<a href=\"mygrades.php?id=".$_GET['id']."\" class=\"navlink\">Ocene</a>".
				 "</div>";
		}
		else if($_SESSION['gid'] == 2){
			echo "<div id=\"jump\">".
					 "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"home.php\" class=\"navlink\">Glavna</a>".
					 "&nbsp;>&nbsp;<a href=\"students.php\" class=\"navlink\">Studenti</a>".
					 "&nbsp;>&nbsp;<a href=\"mygrades.php?id=".$_GET['id']."\" class=\"navlink\">Ocene studenta</a>".
				 "</div>";
		}
		else{
			echo "<div id=\"jump\">".
					 "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"home.php\" class=\"navlink\">Glavna</a>".
				 "</div>";
		}
		
?>
		<table style='background-color:red;'>
<?php	
		$query = "SELECT ROUND(AVG(g.grade), 2) AS avg ".
				 "FROM text AS t ".
				 "JOIN grades AS g ".
					"ON t.id = g.ida ".
				 "WHERE g.ids = :ids";
		$statement = $db->connection->prepare($query);
		$statement->bindParam(":ids", $_GET['id']);
		$statement->execute();
		
		$result = $statement->fetch();
		
		if($result->avg == null){
			echo "<tr>".
					"<td style=\"text-align:center;\">Student nije uradio ni jedan zadatak ili zadaci nisu ocenjeni</td>".
				 "</tr>";
		}
		else{
			echo "<tr>".
					"<td style=\"text-align:center;\"><b>Prosek:</b> ".$result->avg."</td>".
				 "</tr>";

			$query = "SELECT t.id AS ida, t.text AS text, g.ids AS ids, g.grade AS grade ".
					 "FROM text AS t ".
					 "JOIN grades AS g ".
						"ON t.id = g.ida ".
					 "WHERE g.ids = :ids";
			$statement = $db->connection->prepare($query);
			$statement->bindParam(":ids", $_GET['id']);
			$statement->execute();
			$cnt = $statement->rowCount();
			
			for($i = 0; $i < $cnt; $i++){
				$result = $statement->fetch();
				echo "<tr>".
						"<td style=\"text-align:center;\"><b>Zadatak:</b> ".$result->text." <b>Ocena:</b> ".$result->grade."</td>".
					 "</tr>";
			}
		
		}
	}
?>
		</table>
	</body>
</html>