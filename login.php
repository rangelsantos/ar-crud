<?php
session_start();
require_once ("banco/pdo.php");

if (empty($_POST['email']) OR empty($_POST['senha'])) {
    die('Preencha corretamente o formulário.');
}

$email = $_POST['email'];
$senha = sha1($_POST['senha']);
$pdo = new usePDO();
$result = $pdo->sql("SELECT * FROM usuario WHERE email = '$email' AND senha = '$senha'");

if($result->rowCount() == 1){
    $usuario = $result->fetch();
    $_SESSION['status'] = true;
    $_SESSION['email'] = $usuario->email;

    header("location: home.php");
    die();
} else {
    echo "<h1>Erro de login</h1>";
}