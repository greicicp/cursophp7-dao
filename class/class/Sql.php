<?php

class Sql extends PDO {               // tudo que o PDO (que é nativo do PHP) já faz, esta classe consegue fazer: bindParameter, execute, prepare, porque são métodos públicos
	private $conn;

	public function __construct() {

		$this->conn = new PDO("mysql:host=localhost;dbname=dbphp7", "root", "");
		// quando for feito um new Sql e ele já sabe como conecta no banco
	}

	private function setParams($statement, $parameters = array()) {
		foreach ($parameters as $key => $value ) { 
			$this->setParam($statement, $key, $value);
		}
	}


 	private function setParam($statement, $key, $value)  {
 		$statement->bindParam($key, $value);

 	}

	public function query ($rawQuery, $params = array()) {
		$stmt = $this->conn->prepare($rawQuery);
		$this->setParams($stmt, $params);
		$stmt->execute();
		return $stmt;

	}

	public function select($rawQuery, $params = array()):array
	{
		$stmt=$this->query($rawQuery, $params);	
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

}

?>