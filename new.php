<html>
	<head>
		<link rel = "stylesheet" type = "text/css" href = "css/task.css"/>
		<link rel = "stylesheet" type = "text/css" href = "css/nav.css"/>
	</head>
	<body class="bg"><br/> <br/> <br/>
		<?php
			require_once("utl/redirect.php");
	
			require_once("nav.php");
		?>
		<div id="jump">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="home.php" class="navlink">Glavna</a>
			&nbsp;>&nbsp;<a href="new.php" class="navlink">Novi zadatak</a>
		</div><br/> <br/> <br/>
		<form method = "post" action = "process.php" id="form">
			<textarea id = "zadatak" name = "zadatak" rows = "7" style = "width:100%;"></textarea><br/> <br/> <br/> <br/>
			<table id = "GK">
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
			<input id = "sub" type="submit" onclick = "check(true)" value = "Send"/>
			<input type = "hidden" id = "ids" name = "ids"/>
			<input type = "hidden" id = "emp" name = "emp" value = "0;1;"/>
			<input type = "hidden" id = "acc" name = "acc"/>
			<input type = "hidden" id = "err" name = "err"/>
		<form>
		<p id = "print"></p>
	</body>
	<script src = "js/load.js"></script>
	<script src = "js/lib.js"></script>
</html>