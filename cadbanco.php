<?php
include "layout/header.html";
include "menu.php";
include "session.php";
?>

<h2>Cadastro de Produto</h2>

<form method="POST" action="banco/operations.php?q=cadastrar">
    <div class="form-group">
        <label>Nome</label><input class="form-control" type="text" name="nome"><br>
    </div>
    <div class="form-group">
        <label>Descrição</label><input class="form-control" type="text" name="descricao"><br>
    </div>
    <div class="form-group">
        <label>Codigo</label><input class="form-control" type="text" name="codigo"><br>
    </div>
    <div class="form-group">
        <label>Fabricante</label><input class="form-control" type="text" name="fabricante"><br>
    </div>
    <div class="form-group">
        <label>Validade</label><input class="form-control" type="date" name="validade"><br>
    </div>
    <button class="btn btn-primary" type="submit">Cadastrar<br>
</form>

<?php include "layout/footer.html" ?>