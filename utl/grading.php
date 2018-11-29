<?php
	session_start();

	require_once('db.php');

	if(!empty($_POST)){
		$grade = $_POST["grade"];
		$query = "INSERT INTO grades(ids, idp, ida, grade)".
				 "VALUES(:ids, :idp, :ida, :grade)";
		$statement = $db->connection->prepare($query);
		$statement->bindParam(":ids", $_POST['ids']);
		$statement->bindParam(":ida", $_POST['ida']);
		$statement->bindParam(":idp", $_SESSION['uid']);
		$statement->bindParam(":grade", $_POST['grade']);
		$statement->execute();
		header("Location: ..\grade.php");
	}
?>