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
			&nbsp;>&nbsp;<a href="grade.php" class="navlink">Predati zadaci</a>
			&nbsp;>&nbsp;<a href="check.php?ids=<?php echo $_GET['ids']?>&ida=<?php echo $_GET['ida']?>" class="navlink">Provera zadatka</a>
		</div>
		<form method = "post" action = "utl/grading.php" id="form">
			<table id = "GK">
			<?php
				
				if(!empty($_GET)){
					$query = "SELECT text AS text, (SELECT username FROM user WHERE id = :ids) AS user FROM text WHERE id = :ida";
					$statement = $db->connection->prepare($query);
					$statement->bindParam(":ida", $_GET['ida']);
					$statement->bindParam(":ids", $_GET['ids']);
					$statement->execute();
					$result = $statement->fetch();
					
					echo "<tr>".
							"<td colspan=\"5\" style=\"text-align:center;\"><br/><h3>".$result->text."</h3><h4>Rad ".$result->user."</h4></td>".
						 "</tr>";
				
					$query = "SELECT d_acc AS d_acc, p_acc AS p_acc, acc_name AS acc_name, d_amount AS d_amount, p_amount AS p_amount ".
							 "FROM completed ".
							 "WHERE ".
								"ids = :ids ".
								"AND ida = :ida ".
							 "ORDER BY row ASC";
					$statement = $db->connection->prepare($query);
					$statement->bindParam(":ids", $_GET['ids']);
					$statement->bindParam(":ida", $_GET['ida']);
					$statement->execute();
					$cnt = $statement->rowCount();
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
			<?php
				for($i = 0; $i < $cnt; $i++){
					$result = $statement->fetch();
					echo "<tr>".
							"<td>".$result->d_acc."</td>".
							"<td>".$result->p_acc."</td>".
							"<td>".$result->acc_name."</td>".
							"<td>".$result->d_amount."</td>".
							"<td>".$result->p_amount."</td>".
						 "</tr>";
				}
			?>
			</table><br/>	
			<input id = "sub" type="submit" onclick = "gradeIt()" value = "Oceni"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			Ocena:&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="grade" name="grade"/>
			<input type = "hidden" id = "ids" name = "ids" value="<?php echo $_GET['ids']?>"/>
			<input type = "hidden" id = "ida" name = "ida" value="<?php echo $_GET['ida']?>"/><br/><br/>
			<table>
				<tr>
					<td colspan = "5" style="text-align:center;"><br/><h3>Resenje</h3></td>
				</tr>
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
				<?php
					$query = "SELECT d_acc AS d_acc, p_acc AS p_acc, acc_name AS acc_name, d_amount AS d_amount, p_amount AS p_amount ".
							 "FROM assignment WHERE id = :ida ".
							 "ORDER BY d_acc DESC, p_acc DESC";
					$statement = $db->connection->prepare($query);
					$statement->bindParam(":ida", $_GET['ida']);
					$statement->execute();
					$cnt = $statement->rowCount();
					for($i = 0; $i < $cnt; $i++){
						$result = $statement->fetch();
						echo "<tr>".
								"<td>".$result->d_acc."</td>".
								"<td>".$result->p_acc."</td>".
								"<td>".$result->acc_name."</td>".
								"<td>".$result->d_amount."</td>".
								"<td>".$result->p_amount."</td>".
							 "</tr>";
					}
				?>
			</table>
		<form>
	</body>
	<script src = "js/load.js"></script>
	<script src = "js/lib.js"></script>
</html>