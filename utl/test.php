<?php
	require_once('db.php');
	
	if(!empty($_POST)){
		$flag = true;
		$err = "";
		$i = 1;
		$req = $_POST['data'];
		$data = array(
					"side" => array(),
					"acc" => array(),
					"desc" => array(),
					"val" => array()
				);
		$req = substr($req, 0, -1);
		$req = explode("/" ,$req);
		foreach($req as $s){
			$s = explode(";", $s);
			array_push($data["side"], $s[0]);
			if(preg_match("/^[0-9]{3}$/", $s[1])){
				array_push($data["acc"], $s[1]);
			}
			else{
				$flag = false;
				$err = "Konto je unet u pogresnom formatu u redu ".$i;
				break;
			}
			
			if(preg_match("/(^[+|-]?\d*\.?\d*[0-9]+\d*$)|(^[+|-]?[0-9]+\d*\.\d*$)/", $s[2])){
				array_push($data["val"], $s[2]);
			}
			else{
				$flag = false;
				$err = "Iznos je unet u pogresnom formatu u redu ".$i;
				break;
			}
			
			if(strpos($s[3], ";") !== false || strpos($s[3], "/") !== false || strpos($s[3], "\\") !== false){
				$flag = false;
				$err = "Opis u redu ".$i." ne sme da sadrzi tacku-zarez ili kose crte";
				break;
			}
			else{
				array_push($data["desc"], $s[3]);
			}
			$i++;
		}
		
		if($flag == true){
			try{
				$statement = $db->connection->prepare("SELECT MAX(id) AS id FROM text;");
				$statement->execute();
				$id = $statement->fetch();
				$id = $id->id;
				$id++;
			
				$queryD = "INSERT INTO assignment(id, d_acc, acc_name, d_amount)VALUES(:id, :d_acc, :acc_name, :d_amount);";
				$queryP = "INSERT INTO assignment(id, p_acc, acc_name, p_amount)VALUES(:id, :p_acc, :acc_name, :p_amount);";
				$sz = count($data["side"]);
				for($i = 0; $i < $sz; $i++){
					if($data["side"][$i] == "D"){
						$statement = $db->connection->prepare($queryD);
						$statement->bindParam(":d_acc", $data["acc"][$i]);
						$statement->bindParam(":d_amount", $data["val"][$i]);
					}
					else{
						$statement = $db->connection->prepare($queryP);
						$statement->bindParam(":p_acc", $data["acc"][$i]);
						$statement->bindParam(":p_amount", $data["val"][$i]);
					}
					$statement->bindParam(":id", $id);
					$statement->bindParam(":acc_name", $data["desc"][$i]);
					$statement->execute();
				}
				$statement = $db->connection->prepare("INSERT INTO text(id, text)VALUES(:id, :text);");
				$statement->bindParam(":id", $id);
				$statement->bindParam(":text", $_POST["txt"]);
				$statement->execute();
				
				echo "OK";
				
			}
			catch(Exception $e){
				echo $e->getMessage();
			}
		}
		else{
			echo $err;
		}
	}
?>