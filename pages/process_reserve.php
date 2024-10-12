<?php
session_start();
include '../config/database.php';

// Verificar se o usuário está logado e se há uma data na sessão
if (isset($_SESSION['user_id']) && isset($_SESSION['selected_date'])) {
    $user_id = $_SESSION['user_id'];
    $reservation_date = $_SESSION['selected_date'];

    // Verificar se a data já está reservada ou pendente
    $stmt = $pdo->prepare("SELECT * FROM reservations WHERE reserved_date = ? AND status IN ('pendente', 'confirmada')");
    $stmt->execute([$reservation_date]);
    $existing_reservation = $stmt->fetch();

    if ($existing_reservation) {
        echo "Essa data já está reservada ou pendente. Por favor, escolha outra.";
        exit;
    }

    // Inserir a reserva no banco de dados com status "pendente"
    $stmt = $pdo->prepare("INSERT INTO reservations (user_id, reserved_date, status) VALUES (?, ?, 'pendente')");
    if ($stmt->execute([$user_id, $reservation_date])) {
        // Redirecionar para a página de pagamento
        header('Location: payment.php?reservation_id=' . $pdo->lastInsertId());
        exit;
    } else {
        echo "Erro ao fazer a reserva.";
    }
} else {
    echo "Erro: Nenhuma data de reserva selecionada ou o usuário não está logado.";
    exit;
}
?>