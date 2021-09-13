<?php include "layout/header.html" ?>

<h2>Acesso a Base de Dados</h2>

<form method="POST" action="login.php">
    <label>Email:</label><input type="text" name="email"><br>
    <label>Senha:</label><input type="text" name="senha"><br>
    <input type="submit" value="Entrar"><br>
</form>
<div>
    <a href="cadastro.php">Cadastrar</a>
</div>

<?php include "layout/footer.html" ?>