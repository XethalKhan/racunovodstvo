<html>
	<head>
		<link rel = "stylesheet" type = "text/css" href = "css/task.css"/>
		<link rel = "stylesheet" type = "text/css" href = "css/nav.css"/>
	</head>
	<body style = 'background-image: url("img/img1.jpg");'><br/><br/><br/>
		<?php
			require_once("utl/redirect.php");
				
			require_once('utl/db.php');
		
			require_once("nav.php");
		?>
		<div id="jump">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="home.php" class="navlink">Glavna</a>
			&nbsp;>&nbsp;<a href="assignments.php" class="navlink">Zadaci</a>
			&nbsp;>&nbsp;<a href="quest.php?id=<?php echo $_GET['id']?>" class="navlink">Trenutni zadatak</a>
		</div>
		<form method = "post" action = "utl/insert.php" id="form">
			<table id = "GK">
			<?php
				
				if(!empty($_GET)){
					$statement = $db->connection->prepare("SELECT text AS text FROM text WHERE id = :id;");
					$statement->bindParam(":id", $_GET['id']);
					$statement->execute();
					if($statement->rowCount() > 0){
						$result = $statement->fetch();
						echo "<tr style='text-align:center;'>".
								"<td colspan='5' style='padding:10px;'>".$result->text."</td>".
							 "</tr>";
					}
				}
			?>
				<tr>
					<td colspan = "2" class = "header row1">Konto</td>
					<td rowspan = "2" class = "header">Opis</td>
					<td colspan = "2" class = "header row3">Iznos</td>
				</tr>
				<tr>
					<td class = "header subrow1">Duguje</td>
					<td class = "header subrow1">Potrazuje</td>
					<td class = "header subrow3">Duguje</td>
					<td class = "header subrow3">Potrazuje</td>
				</tr>
				<tr>
					<td><input type = "text" class="Dk data" name = "Dk[]"/></td>
					<td><input type = "text" class="Pk data" name = "Pk[]"/></td>
					<td><input type = "text" class="O data" name = "O[]"/></td>
					<td><input type = "text" class="Di data" name = "Di[]"/></td>
					<td><input type = "text" class="Pi data" name = "Pi[]"/></td>
				</tr>
				<tr>
					<td><input type = "text" class="Dk data" name = "Dk[]"/></td>
					<td><input type = "text" class="Pk data" name = "Pk[]"/></td>
					<td><input type = "text" class="O data" name = "O[]"/></td>
					<td><input type = "text" class="Di data" name = "Di[]"/></td>
					<td><input type = "text" class="Pi data" name = "Pi[]"/></td>
				</tr>
			</table><br/>
			<button type="button" id="nr" onclick="newRow();">NEW ROW</button><br/>
			<input id = "sub" type="submit" onclick = "sendtask();" value = "Send"/>
			<input type = "hidden" id = "tid" name = "tid" value="<?php echo $_GET['id']?>"/>
		<form>
	</body>
	<script src = "js/load.js"></script>
	<script src = "js/lib.js"></script>
</html>
