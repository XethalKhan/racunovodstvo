<?php
	class db{
	
		//property declaration
		private $host;
		private $db;
		private $username;
		private $password;
		
		private $options = [
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
		];
		
		public $connection;
		
		//constructor declaration
		function __construct($host, $db, $username, $password){
		
			try{
				
				$this->host = $host;
				$this->db = $db;
				$this->username = $username;
				$this->password = $password;
				$this->connection = new PDO('mysql:host='.$host.';dbname='.$db, $username, $password, $this->options);
				
			}catch(PDOException $e){

				// user message
				echo 'Error while trying to connect to database';

			}
		}
	}
	
	//instance of database, use session variables to make it for specific group of users
	$db = new db("localhost", "acc", "admin", "admin");
?>