<?php
session_start();
include '../config/database.php';

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $reservation_date = $_POST['reservation_date'];

    // Armazenar a data da reserva na sessão
    $_SESSION['selected_date'] = $reservation_date;

    // Redirecionar o usuário para o login, ou processar o pagamento se já estiver logado
    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit;
    } else {
        // Redirecionar para o processo de pagamento
        header('Location: process_reserve.php');
        exit;
    }
}

// Buscar todas as datas já reservadas ou pendentes
$stmt = $pdo->prepare("SELECT reserved_date FROM reservations WHERE status IN ('pendente', 'confirmada')");
$stmt->execute();
$reserved_dates = $stmt->fetchAll(PDO::FETCH_COLUMN);

// Convertendo as datas reservadas em um formato adequado para o calendário
$events = [];
foreach ($reserved_dates as $date) {
    $events[] = ['title' => 'Ocupada', 'start' => $date, 'color' => 'red'];
}

include '../templates/header.php';  // Inclui o header
?>

<h2>Agendar uma Reserva</h2>

<!-- Calendário para exibir datas bloqueadas -->
<div id="calendar"></div>

<!-- Formulário de agendamento -->
<form action="" method="POST">
    <div class="form-group">
        <label for="reservation_date">Selecione uma data disponível:</label>
        <input type="date" class="form-control" id="reservation_date" name="reservation_date" required>
    </div>
    <button type="submit" class="btn btn-primary">Agendar</button>
</form>

<script>
// Exibir o calendário com as datas bloqueadas
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: <?php echo json_encode($events); ?>, // Passa as datas ocupadas para o calendário
        selectable: true,
        dateClick: function(info) {
            // Preenche o campo de data do formulário com a data selecionada
            document.getElementById('reservation_date').value = info.dateStr;
        }
    });
    calendar.render();
});
</script>

<?php include '../templates/footer.php'; ?>
