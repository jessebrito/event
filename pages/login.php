<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Buscar o usuário pelo email
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verificar se o usuário existe e se a senha está correta
    if ($user && password_verify($password, $user['password'])) {
        // Armazenar o ID do usuário na sessão
        $_SESSION['user_id'] = $user['id'];

        // Verificar se há uma data de reserva armazenada
        if (isset($_SESSION['selected_date'])) {
            // Redirecionar para o processo de reserva
            header('Location: process_reserve.php');
            exit;
        } else {
            // Caso não haja data, redirecionar para a página inicial
            header('Location: index.php');
            exit;
        }
    } else {
        $error_message = "E-mail ou senha inválidos."; // Salvar mensagem de erro para exibir depois
    }
}

// Inclua o header apenas após processar o login
include '../templates/header.php';

if (isset($error_message)) {
    echo "<div class='alert alert-danger'>$error_message</div>";
}
?>

<!-- Formulário de login -->
<form method="POST" class="mt-4">
    <div class="form-group">
        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="password">Senha:</label>
        <input type="password" id="password" name="password" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Entrar</button>
</form>

<?php include '../templates/footer.php'; ?>
