<?php
session_start();
include '../config/database.php';

// Verificar se o administrador está logado
if (!isset($_SESSION['admin_id'])) {
    header('Location: admin_login.php');
    exit;
}

// Buscar todas as reservas (pendentes, confirmadas e as feitas para a ONG)
$stmt = $pdo->prepare("SELECT r.id, r.reserved_date, r.status, u.name, u.email, r.user_id 
                        FROM reservations r 
                        LEFT JOIN users u ON r.user_id = u.id 
                        WHERE r.status IN ('pendente', 'confirmada') OR r.user_id IS NULL");
$stmt->execute();
$reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Convertendo as reservas em eventos para o calendário
$events = [];
foreach ($reservations as $reservation) {
    // Verificar se o user_id está definido
    if (!isset($reservation['user_id']) || $reservation['user_id'] === null) {
        $color = 'blue'; // Cor para reservas da ONG
        $title = 'Reservado para ONG'; // Título da reserva para a ONG
    } else {
        $color = ($reservation['status'] == 'pendente') ? 'orange' : 'green'; // Cor diferente para pendentes e confirmadas
        $title = $reservation['name'] . ' - ' . $reservation['status']; // Exibe o nome e o status no calendário
    }

    $events[] = [
        'title' => $title,
        'start' => $reservation['reserved_date'],
        'color' => $color
    ];
}

include '../templates/header.php';  // Inclui o header
?>

<h2>Painel do Administrador - Calendário de Reservas</h2>

<!-- Calendário para exibir datas pendentes, confirmadas e reservadas para a ONG -->
<div id="admin_calendar"></div>

<!-- Formulário para reservar uma data para a ONG -->
<form id="reserve_form" action="reserve_date_ong.php" method="POST" style="display:none;">
    <input type="hidden" id="reserve_date" name="reserve_date">
    <button type="submit" class="btn btn-primary">Reservar para a ONG</button>
</form>

<!-- Tabela para mostrar detalhes das reservas -->
<h3>Detalhes das Reservas</h3>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Nome do Usuário</th>
            <th>E-mail</th>
            <th>Data da Reserva</th>
            <th>Status</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($reservations as $reservation): ?>
            <tr>
                <td><?php echo $reservation['name'] ?? 'ONG'; ?></td>
                <td><?php echo $reservation['email'] ?? 'Reservado para ONG'; ?></td>
                <td><?php echo $reservation['reserved_date']; ?></td>
                <td><?php echo ucfirst($reservation['status']); ?></td>
                <td>
                    <?php if ($reservation['status'] == 'pendente'): ?>
                        <form action="confirm_reservation.php" method="POST" style="display:inline;">
                            <input type="hidden" name="reservation_id" value="<?php echo $reservation['id']; ?>">
                            <button type="submit" class="btn btn-success">Confirmar</button>
                        </form>
                    <?php endif; ?>
                    <form action="cancel_reservation.php" method="POST" style="display:inline;">
                        <input type="hidden" name="reservation_id" value="<?php echo $reservation['id']; ?>">
                        <button type="submit" class="btn btn-danger">Cancelar</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
// Exibir o calendário com as datas pendentes, confirmadas e reservadas para a ONG
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('admin_calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: <?php echo json_encode($events); ?>, // Passa as reservas para o calendário
        dateClick: function(info) {
            // Quando o administrador clica em uma data, o formulário de reserva é exibido
            document.getElementById('reserve_date').value = info.dateStr; // Define a data clicada
            document.getElementById('reserve_form').style.display = 'block'; // Exibe o formulário
        }
    });
    calendar.render();
});
</script>

<?php include '../templates/footer.php';  // Inclui o footer ?>
