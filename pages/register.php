<?php include '../templates/header.php'; ?>

<h2>Cadastro de Usuário</h2>
<form action="../actions/register_user.php" method="POST">
  <div class="form-group">
    <label for="name">Nome</label>
    <input type="text" class="form-control" id="name" name="name" required>
  </div>
  <div class="form-group">
    <label for="cpf">CPF</label>
    <input type="text" class="form-control" id="cpf" name="cpf" required>
  </div>
  <div class="form-group">
    <label for="email">E-mail</label>
    <input type="email" class="form-control" id="email" name="email" required>
  </div>
  <div class="form-group">
    <label for="password">Senha</label>
    <input type="password" class="form-control" id="password" name="password" required>
  </div>
  <button type="submit" class="btn btn-primary">Registrar</button>
</form>

<?php include '../templates/footer.php'; ?>