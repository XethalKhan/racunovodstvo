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
		<?php 
			if(!empty($_POST)){
				if(!empty($_POST["ids"]) && !empty($_POST["zadatak"])){
					$ids = substr($_POST["ids"], 0, -1);
					$ids = explode(";", $ids);
					$acc = substr($_POST["acc"], 0, -1);
					$acc = explode(";", $acc);
					$ix = 0;
					$data = array(
						"side" => array(),
						"acc" => array(),
						"desc" => array(),
						"val" => array()
					);
					$tbl = "<table id = 'GK'>"
									. "<tr>"
									. "<td colspan = '2' class = 'header row1'>Konto</td>"
									. "<td rowspan = '2' class = 'header'>Opis</td>"
									. "<td colspan = '2' class = 'header row3'>Iznos</td>"
								. "</tr>"
								. "<tr>"
									. "<td class = 'header subrow1'>Duguje</td>"
									. "<td class = 'header subrow1'>Potrazuje</td>"
									. "<td class = 'header subrow3'>Duguje</td>"
									. "<td class = 'header subrow3'>Potrazuje</td>"
								. "</tr>";
					foreach($ids as $id){
						if($acc[$ix] == "D"){
							array_push($data["side"], "D");
							array_push($data["acc"], trim($_POST["Dk"][$id]));
							array_push($data["val"], trim($_POST["Di"][$id]));
							$ix = $ix + 1;
						}else{
							array_push($data["side"], "P");
							array_push($data["acc"], trim($_POST["Pk"][$id]));
							array_push($data["val"], trim($_POST["Pi"][$id]));
							$ix = $ix + 1;
						}
						array_push($data["desc"], trim($_POST["O"][$id]));
					}
					
					for($i = 0; $i < $ix; $i++){
						if($data["side"][$i] == "D"){
							$tbl = $tbl . "<tr>" 
									. "<td class = 'amount'>" . $data["acc"][$i] . "</td>" 
									. "<td class = 'amount'></td>" 
									. "<td class = 'account'>" . $data["desc"][$i] . "</td>" 
									. "<td class = 'amount'>" . $data["val"][$i] . "</td>"
									. "<td class = 'amount'></td>" 
									. "</tr>";
						}
					}
					
					for($i = 0; $i < $ix; $i++){
						if($data["side"][$i] == "P"){
							$tbl = $tbl . "<tr>" 
									. "<td class = 'amount'></td>" 
									. "<td class = 'amount'>" . $data["acc"][$i] . "</td>" 
									. "<td class = 'account'>" . $data["desc"][$i] . "</td>" 
									. "<td class = 'amount'></td>" 
									. "<td class = 'amount'>" . $data["val"][$i] . "</td>"
									. "</tr>";
						}
					}
					
					$tbl = $tbl . "</table>";
					echo $tbl;
				}
			}
		?>
		<button type="button" id="sub" onclick="newtask();">Potvrdi</button><br/>
		<input type = "hidden" id = "data" value = 
			"<?php 
				$msg = "";
				for($i = 0; $i < $ix; $i++){
					$msg = $msg
						. $data["side"][$i] . ";"
						. $data["acc"][$i] . ";"
						. $data["val"][$i] . ";"
						. $data["desc"][$i] . "/";
				}
				echo $msg;
			?>"/>
		<input type = "hidden" id = "txt" value = "<?php echo $_POST["zadatak"];?>"/>
	</body>
	<script src = "js/load.js"></script>
	<script src = "js/lib.js"></script>
</html>