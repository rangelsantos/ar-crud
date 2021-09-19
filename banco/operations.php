<?php

require_once("pdo.php");

$q = $_REQUEST["q"];
$pdo = new usePDO();
$pdo->createDB();
$pdo->createTableUsuarios();
$pdo->createTableProdutos();

switch ($q) {
    case "cadastrarusuario":
        $email = $_REQUEST["email"];
        $senha = $_REQUEST["senha"];
        $message = $pdo->insert("INSERT INTO usuario (email, senha)
        VALUES ('$email', '" . sha1($senha) . "')");
        if ($message != NULL) {
            echo($message);           
        } else {
            echo("Cadastro efetivado!");
            header("location: ../index.php");
        }
        break;
    case "cadastrar":
        $nome = $_REQUEST["nome"];
        $descricao = $_REQUEST["descricao"];
        $codigo = $_REQUEST["codigo"];
        $fabricante = $_REQUEST["fabricante"];
        $validade = $_REQUEST["validade"];
        $message = $pdo->insert("INSERT INTO produto (
            nome, descricao, codigo, fabricante, validade)
            VALUES ('$nome','$descricao','$codigo','$fabricante','$validade')");
        if ($message != NULL) {
            echo($message);
        } else {           
            echo("Cadastro efetivado!");
            header("location: ../cadbanco.php");
        }
        break;
    case "consulta":
        $result = $pdo->sql("SELECT * FROM produto");
        print(json_encode($result->fetchAll()));
        break;
    case "atualizar":
        $id = $_REQUEST["id"];
        $nome = $_REQUEST["nome"];
        $descricao = $_REQUEST["descricao"];
        $codigo = $_REQUEST["codigo"];
        $fabricante = $_REQUEST["fabricante"];
        $validade = $_REQUEST["validade"];
        $result = $pdo->sql("UPDATE produto SET nome='$nome', descricao='$descricao', codigo='$codigo', fabricante='$fabricante', validade='$validade' WHERE id='$id'");
        echo "Registro atualizado com sucesso";
        break;
    case "remover":
        $id = $_REQUEST["id"];
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
