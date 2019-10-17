<?php

require_once("config.php");

//$sql = new Sql();

//$usuarios = $sql->select("SELECT * FROM tb_usuarios");

//echo json_encode($usuarios);
//****************************************
// carrega apenas 1 usuário
//$root = new Usuario();
//
//$root->loadbyId(3);

//echo $root;

//***************************************
// carrega uma lista de usuários
//$lista = Usuario::getList();
//echo json_encode($lista);


//***************************************
// carrega uma lista de usuários buscando pelo login
//$search = Usuario::search("a");
//echo json_encode($search);



//***************************************
// carrega um usuários buscando pelo login e senha
$usuario = new Usuario();
$usuario->login("root", "?@#$");

echo $usuario;

?>