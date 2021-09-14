<?php

require_once("pdo.php");

$q = $_REQUEST["q"];
$pdo = new usePDO();
$pdo->createDB();
$pdo->createTableUsuarios();
$pdo->createTableProdutos();

$id = $_REQUEST["id"];
$nome = $_REQUEST["nome"];
$descricao = $_REQUEST["descricao"];
$codigo = $_REQUEST["codigo"];
$fabricante = $_REQUEST["fabricante"];
$validade = $_REQUEST["validade"];

switch($q){
    case "cadastrarusuario":
        $email = $_REQUEST["email"];
        $senha = $_REQUEST["senha"];       
        $message = $pdo->insert("INSERT INTO usuario (email, senha)
        VALUES ('$email', '".sha1($senha)."')");
        if($message != NULL){
            header("location: resultado.php?message=$message");
        } else {
            header("location: index.html?message=Sucesso!");
        }
        break;
    case "cadastrar":
        $message = $pdo->insert("INSERT INTO produto (
            nome, descricao, codigo, fabricante, validade)
            VALUES ('$nome','$descricao','$codigo','$fabricante','$validade')");
        break;
    case "consulta":
        $result = $pdo->sql("SELECT * FROM produto");
		print(json_encode($result->fetchAll()));
        break;
    case "atualizar":
        $result = $pdo->sql("UPDATE produto SET nome='$nome', descricao='$descricao', codigo='$codigo', fabricante='$fabricante', validade='$validade' WHERE id='$id'");
        echo "Registro id $id atualizado com sucesso";
        break;
    case "remover":
    	$pdo->sql("DELETE FROM produto WHERE id='$id'");
    	echo "Registro deletado com sucesso";
        break;
    case "login":
        $email = $_REQUEST["email"];
        $senha = $_REQUEST["senha"];
        $result = $pdo->sql("SELECT * FROM usuario WHERE email = '$email' AND senha = '$senha'");
        print(json_encode($result->fetchAll()));
        break;
}