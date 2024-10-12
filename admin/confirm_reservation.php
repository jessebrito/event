<?php
session_start();
include '../config/database.php';

// Verificar se o administrador está logado
if (!isset($_SESSION['admin_id'])) {
    header('Location: admin_login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $reservation_id = $_POST['reservation_id'];

    // Atualizar o status da reserva para 'confirmada'
    $stmt = $pdo->prepare("UPDATE reservations SET status = 'confirmada' WHERE id = ?");
    if ($stmt->execute([$reservation_id])) {
        header('Location: admin_dashboard.php');
        exit;
    } else {
        echo "Erro ao confirmar a reserva.";
    }
}
?>
