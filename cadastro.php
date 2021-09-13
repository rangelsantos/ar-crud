<?php include "layout/header.html" ?>

<h2>Cadastro de Usuario</h2>

<form method="POST" action="banco/operations.php?q=cadastrarusuario">
    <label>Email:</label><input type="text" name="email"><br>
    <label>Senha:</label><input type="text" name="senha"><br>
    <input type="submit" value="Cadastrar"><br>
</form>

<?php include "layout/footer.html" ?>