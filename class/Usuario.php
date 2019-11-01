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

	
// linhas abaixo, agora utilizando setData()

//			$row = $results[0];            // como é um array de array, e retorna apenas 1 reg, pegamos a posição zero

//			$this->setIdusuario($row['idusuario']); //envia os dados recebidos para os set´s
//			$this->setDesclogin($row['desclogin']);
//			$this->setDessenha($row['dessenha']);
//			$this->setDtcadastro(new DateTime($row['dtcadastro']));		// vem no formato ano/mes/dia	
			$this->setData($results[0]);    // nova linha, após comentar as linhas acima
		}

	}


	public function __toString() {
		return json_encode(array (      // vamos retornar os dados num json_encode com um array, com os nomes
		"idusuario"=>$this->getIdusuario(),    // que eu quero que ele exiba (nome dos campos da tabela), usando os get
		"desclogin"=>$this->getDesclogin(),			 // para trazer os dados
		"dessenha"=>$this->getDessenha(),
		"dtcadastro"=>$this->getDtcadastro()->format('d/m/Y H:i:s'),	// é um objeto datetime, que tem o método format que pode ser utilizado
		));
	}



// listar todos os usuários da tabela
	public static function getList() { //método static não precisa ser instanciado para ser utilizado, chama com: usuario::getList

		$sql = new Sql();
		return $sql->select("Select * FROM tb_usuarios ORDER BY desclogin;");

	}

	public static function search($login) {
		$sql = new Sql();
		return $sql->select("Select * from tb_usuarios WHERE desclogin LIKE :search ORDER BY desclogin", array(
				':search'=>"%".$login."%"));
	}


	public function login($Login, $password) {
		$sql = new SQL();

		$results = $sql->select("SELECT * FROM tb_usuarios WHERE desclogin = :login and dessenha = :password", array(
			":login"=>$Login,
			":password"=>$password			
		));
		if (count($results) > 0) {         // ou if (isset($results[0]))

			//$row = $results[0];            // como é um array de array, e retorna apenas 1 reg, pegamos a posição zero

// linhas abaixo, colocadas da função setData();
//			$this->setIdusuario($row['idusuario']); //envia os dados recebidos para os set´s
//			$this->setDesclogin($row['desclogin']);
//			$this->setDessenha($row['dessenha']);
//			$this->setDtcadastro(new DateTime($row['dtcadastro']));		// vem no formato ano/mes/dia	
			$this->setData($results[0]);
		} else {
			throw new Exception("Login e/ou senha invalidos");
		}


	}

	public function setData($data){
			$this->setIdusuario($data['idusuario']); //envia os dados recebidos para os set´s
			$this->setDesclogin($data['desclogin']);
			$this->setDessenha($data['dessenha']);
			$this->setDtcadastro(new DateTime($data['dtcadastro']));		// vem no formato ano/mes/dia						

	} 


	public function insert() {
		$sql = new Sql();

		$results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)", array(// procedure no MySql é chamada com CALL, se for sqlserver é com Execute
			':LOGIN'=>$this->getDesclogin(),	
			':PASSWORD'=>$this->getDessenha()			
		));

		if (count($results) > 0) {
			$this->setData($results[0]);
		}
	}

	public function delete(){
		$sql = new Sql();
		$sql->query("DELETE FROM tb_usuarios WHERE idusuario = :ID", array(
				':ID'=>$this->getIdusuario()

		));    // depois que apaga no banco, melhor zerar na memória do objeto
		$this->setIdusuario(0);
		$this->setDesclogin("");
		$this->setDessenha("");
		$this->setDtcadastro(new DateTime());
	}	

	public 	function atualiza($login="", $password="") {		
			$this->setDesclogin($login);
			$this->setDessenha($password);
			$sql = new Sql();
			$sql->query("Update tb_usuarios SET desclogin = :LOGIN, dessenha= :PASSWORD WHERE idusuario = :ID", array(
							':LOGIN'=>$this->getDesclogin(),
							':PASSWORD'=>$this->getDessenha(),
							':ID'=>$this->getIdusuario()
						));

	}


	public function __construct($login="", $password="") {
			$this->setDesclogin($login);
			$this->setDessenha($password);

	}

}

 ?>