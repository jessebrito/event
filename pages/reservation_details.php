<?php
session_start();
include '../config/database.php';  // Inclua o arquivo de conexão com o banco de dados
include '../templates/header.php';  // Inclua o cabeçalho

// Verificar se o usuário está logado
//if (!isset($_SESSION['user_id'])) {
  //  header('Location: ../login.php');
    //exit;
//}

// Obter o ID da reserva via GET
$reservation_id = $_GET['reservation_id'] ?? null;

if ($reservation_id) {
    // Buscar detalhes da reserva e do organizador no banco de dados
    $stmt = $pdo->prepare("
        SELECT r.id, r.event_name, r.reserved_date, r.status, u.name AS organizer_name, u.email AS organizer_email
        FROM reservations r 
        JOIN users u ON r.user_id = u.id 
        WHERE r.id = ?
    ");
    $stmt->execute([$reservation_id]);
    $reservation = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($reservation) {
        // Exibir os detalhes da reserva e do organizador
        echo "<h2>Detalhes da Reserva</h2>";
        echo "<p><strong>Evento:</strong> " . htmlspecialchars($reservation['event_name']) . "</p>";
        echo "<p><strong>Organizador:</strong> " . htmlspecialchars($reservation['organizer_name']) . "</p>";
        echo "<p><strong>Email do Organizador:</strong> " . htmlspecialchars($reservation['organizer_email']) . "</p>";
        echo "<p><strong>Data do Evento:</strong> " . date('d/m/Y', strtotime($reservation['reserved_date'])) . "</p>";
        echo "<p><strong>Status:</strong> " . ucfirst($reservation['status']) . "</p>";

        // Botão para confirmar a presença (leva ao formulário do módulo de lista de convidados)
        echo "<a href='../guests_module/guest_form.php?reservation_id={$reservation['id']}' class='btn btn-primary'>Confirmar Presença</a>";
    } else {
        echo "<p>Reserva não encontrada.</p>";
    }
} else {
    echo "<p>ID de reserva inválido.</p>";
}

include '../templates/footer.php';  // Inclua o rodapé
?>
