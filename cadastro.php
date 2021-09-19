<?php include "layout/header.html" ?>

<h2 class="center-title">Cadastro de Usuario</h2>

<form method="POST" action="banco/operations.php?q=cadastrarusuario">
<div class="form-group">
    <label>Email</label><input class="form-control" type="email" name="email" placeholder="email"><br>
</div>
<div class="form-group">
    <label>Senha</label><input class="form-control" type="password" name="senha" placeholder="senha"><br>
</div>
    <button type="submit" class="btn btn-primary">Cadastrar<br>
</form>

<?php include "layout/footer.html" ?>