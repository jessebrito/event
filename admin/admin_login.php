<?php
session_start();
include '../config/database.php';

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Verificar se o e-mail e a senha correspondem a um administrador
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? AND is_admin = 1");
    $stmt->execute([$email]);
    $admin = $stmt->fetch();

    if ($admin && password_verify($password, $admin['password'])) {
        // Armazenar as informações do administrador na sessão
        $_SESSION['admin_id'] = $admin['id'];
        header('Location: admin_dashboard.php');
        exit;
    } else {
        echo "E-mail ou senha inválidos.";
    }
}

include '../templates/header.php';  // Inclui o header
?>

<h2>Login de Administrador</h2>
<form action="admin_login.php" method="POST">
    <div class="form-group">
        <label for="email">E-mail</label>
        <input type="email" class="form-control" id="email" name="email" required>
    </div>
    <div class="form-group">
        <label for="password">Senha</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <button type="submit" class="btn btn-primary">Entrar</button>
</form>

<?php include '../templates/footer.php';  // Inclui o footer ?>
