<?php
session_start();
require_once ("banco/pdo.php");

if (empty($_POST['email']) OR empty($_POST['senha'])) {
    die('Preencha corretamente o formulário.');
}

$email = $_POST['email'];
$senha   = sha1($_POST['senha']);


