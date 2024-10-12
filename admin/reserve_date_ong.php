<?php
session_start();
include '../config/database.php';

// Verificar se o administrador está logado
if (!isset($_SESSION['admin_id'])) {
    header('Location: admin_login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $reserve_date = $_POST['reserve_date'];

    // Verificar se a data já está reservada
    $stmt = $pdo->prepare("SELECT * FROM reservations WHERE reserved_date = ?");
    $stmt->execute([$reserve_date]);
    $existing_reservation = $stmt->fetch();

    if ($existing_reservation) {
        echo "Essa data já está reservada.";
    } else {
        // Inserir a reserva para a ONG com o status "confirmada"
        $stmt = $pdo->prepare("INSERT INTO reservations (user_id, reserved_date, status) VALUES (NULL, ?, 'confirmada')");
        if ($stmt->execute([$reserve_date])) {
            header('Location: admin_dashboard.php');
            exit;
        } else {
            echo "Erro ao reservar a data.";
        }
    }
}
?>
