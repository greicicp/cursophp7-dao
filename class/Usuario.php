<?php 

class Usuario {

	private $idusuario;
	private $desclogin;
	private $dessenha;
	private $dtcadastro;

	public function getIdusuario() {
		return $this->idusuario;
	}

	public function setIdusuario($value) {
		$this->idusuario = $value;		
	}



	public function getDesclogin() {
		return $this->desclogin;
	}

	public function setDesclogin($value) {
		$this->desclogin = $value;		
	}


	public function getDessenha() {
		return $this->dessenha;
	}

	public function setDessenha($value) {
		$this->dessenha = $value;		
	}


	public function setDtcadastro($value) {
		$this->dtcadastro = $value;		
	}

	public function getDtcadastro() {
		return $this->dtcadastro;
	}

	public function loadById($id) {
		$sql = new SQL();

		$results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
			":ID"=>$id
		));
		if (count($results) > 0) {         // ou if (isset($results[0]))

			$row = $results[0];            // como é um array de array, e retorna apenas 1 reg, pegamos a posição zero

			$this->setIdusuario($row['idusuario']);
			$this->setDesclogin($row['desclogin']);
			$this->setDessenha($row['dessenha']);
			$this->setDtcadastro(new DateTime($row['dtcadastro']));		// vem no formato ano/mes/dia	
		}

	}

	public function __toString() {

		return json_encode(array (
			"idusuario"=>$this->getIdusuario(),
			"desclogin"=>$this->getDesclogin(),
			"dessenha"=>$this->getDessenha(),
			"dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:m:s"),			// é um objeto datetime, que tem o método format que pode ser utilizado


		));
	}


}

 ?>