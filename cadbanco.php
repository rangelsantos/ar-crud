<?php
include "layout/header.html";
include "menu.php";
include "session.php";
?>

<h2>Cadastro de Produto</h2>

<form method="POST" action="banco/operations.php?q=cadastrar">
    <label>Nome:</label><input type="text" name="nome"><br>
    <label>Descrição:</label><input type="text" name="descricao"><br>
    <label>Codigo:</label><input type="text" name="codigo"><br>
    <label>Fabricante:</label><input type="text" name="fabricante"><br>
    <label>Validade:</label><input type="text" name="validade"><br>
    <input type="submit" value="Cadastrar"><br>
</form>

<?php include "layout/footer.html" ?>