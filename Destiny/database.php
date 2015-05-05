<?php
class Database{

private $host = 'localhost';
private $db_name = 'contacts';
private $username = 'tyrown';
private $password = '121498';
public $conn;


public function getConnection(){

	$this->conn = null;
	
	try{
		$this->conn = new PDO("mysql:host=" .$this->host . ";dbname="
		.$this->db_name, $this->username, $this->password);
	}catch (PDOException $exception){
		echo "Connection error: ". $exception->getMessage();
	}

	return $this->conn;
	



}







}



?>
