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
//$usuario = new Usuario();
//$usuario->login("root", "?@#$");

//echo $usuario;

//***************************************
// insert de um usuario novo
/*echo("Rotina de insert ................");
$aluno = new Usuario();
$aluno->setDescLogin("aluno");
$aluno->setDessenha("@luno0");

$aluno->insert();

echo $aluno;
*/

//*********************************************
// insert de um usuario novo , com construtor
/*$aluno = new Usuario("alunconst", "@56");   // sempre passar os param que são necessários no método construtor

$aluno->insert();

echo $aluno;*/

/* alteração de um usuário */
/*$usuario = new Usuario();
$usuario->loadById(6);
$usuario->atualiza("professor", "!@098");
echo $usuario;
*/

/* Deletar um usuário */
$usuario = new Usuario();
$usuario->loadbyId(7);
$usuario->delete();
echo $usuario;

?>