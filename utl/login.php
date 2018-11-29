<?php
	require_once('db.php');
	
	if(!empty($_POST)){
		$user = trim($_POST["user"]);
		$pass = md5($_POST["pass"]);
		
		try{
				$statement = $db->connection->prepare("SELECT id AS id, username AS user, grp AS grp FROM user WHERE TRIM(username) = :user AND TRIM(password) = :password;");
				$statement->bindParam(":user", $user);
				$statement->bindParam(":password", $pass);
				$statement->execute();
				if($statement->rowCount() > 0){
					$result = $statement->fetch();
					session_start();
					$_SESSION['uid'] = $result->id;
					$_SESSION['gid'] = $result->grp;
					$_SESSION['user'] = $result->user;
					$_SESSION['stime'] = time();
					header("Location: ..\home.php");
					exit;
				}
				else{
					header("Location: ..\index.php");
				}
		}
		catch(Exception $e){
			echo $e->getMessage();
		}
	}

?>