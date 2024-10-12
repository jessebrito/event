<?php
include '../config/database.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Verificar se o usuário existe
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    // Verificar se a senha está correta
    if ($user && password_verify($password, $user['password'])) {
        // Armazenar as informações do usuário na sessão
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];

        // Redirecionar para o dashboard
        header('Location: ../pages/dashboard.php');
    } else {
        echo "E-mail ou senha inválidos.";
    }
}
?>
