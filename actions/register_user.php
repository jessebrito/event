<?php
include '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Criptografando a senha

    // Verificar se o CPF ou e-mail já existem
    $stmt = $pdo->prepare("SELECT * FROM users WHERE cpf = ? OR email = ?");
    $stmt->execute([$cpf, $email]);
    $existingUser = $stmt->fetch();

    if ($existingUser) {
        echo "Usuário já registrado com esse CPF ou E-mail.";
    } else {
        // Inserir o novo usuário
        $stmt = $pdo->prepare("INSERT INTO users (name, cpf, email, password) VALUES (?, ?, ?, ?)");
        if ($stmt->execute([$name, $cpf, $email, $password])) {
            header('Location: ../pages/login.php?success=1');
        } else {
            echo "Erro ao registrar o usuário.";
        }
    }
}
?>
