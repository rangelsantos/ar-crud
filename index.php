<?php
session_start();
$_SESSION['status'] = $_SESSION['status'] ?? NULL;
if ($_SESSION['status'] == true) {
    header("location: home.php");
}
?>
<?php include "layout/header.html"; ?>

<div>
    <h2 class="center-title">Acesso a Base de Dados</h2>

    <form method="POST" action="login.php">
        <div class="form-group">
            <label>Email</label><input class="form-control" type="email" name="email" placeholder="email"><br>
        </div>
        <div class="form-group">
            <label>Senha</label><input class="form-control" type="password" name="senha" placeholder="senha"><br>
        </div>
        <button class="btn btn-primary" type="submit" value="Entrar">Entrar</button><br><br>
    </form>
    <h3>Novo usuario?</h3>
    <div>
        <a class="btn btn-primary" href="cadastro.php">Cadastrar</a>
    </div>
</div>
<?php include "layout/footer.html" ?>