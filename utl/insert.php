<?php
	session_start();
	
	require_once('db.php');
	
	if(!empty($_POST)){
		
		$query = "INSERT INTO completed(ids, ida, row, d_acc, p_acc, acc_name, d_amount, p_amount)".
				 "VALUES(:ids, :ida, :row, :d_acc, :p_acc, :acc_name, :d_amount, :p_amount);";
		
		$cnt = count($_POST["Dk"]);
		for($i = 0; $i < $cnt; $i++){
			$dk = $_POST["Dk"][$i]=='' ? null : trim($_POST["Dk"][$i]);
			$pk = $_POST["Pk"][$i]=='' ? null : trim($_POST["Pk"][$i]);
			$o = trim($_POST["O"][$i]);
			$di = floatval(trim($_POST["Di"][$i]));
			$pi = floatval(trim($_POST["Pi"][$i]));
			
			$statement = $db->connection->prepare($query);
			$statement->bindParam(":ids", $_SESSION["uid"], PDO::PARAM_INT);
			$statement->bindParam(":ida", $_POST["tid"], PDO::PARAM_INT);
			$statement->bindParam(":row", $i, PDO::PARAM_INT);
			$statement->bindParam(":d_acc", $dk);
			$statement->bindParam(":p_acc", $pk);
			$statement->bindParam(":acc_name", $o);
			$statement->bindParam(":d_amount", $di);
			$statement->bindParam(":p_amount", $pi);
			$statement->execute();
		}
		header("Location: ../assignments.php"); 
		
	}
?>