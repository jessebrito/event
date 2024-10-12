<?php
session_start();
include '../config/database.php';

// Verificar se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$reservation_id = $_GET['reservation_id'] ?? null;

if (!$reservation_id) {
    echo "Reserva inválida.";
    exit;
}

include '../templates/header.php';  // Inclui o header
?>

<h2>Enviar Comprovante de Pagamento</h2>

<!-- Formulário de Pagamento -->
<form action="process_payment.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="reservation_id" value="<?php echo $reservation_id; ?>">
    <div class="form-group">
        <label for="comprovante">Envie o comprovante de pagamento:</label>
        <input type="file" class="form-control" id="comprovante" name="comprovante" required>
    </div>
    <button type="submit" class="btn btn-primary">Enviar Comprovante</button>
</form>

<?php include '../templates/footer.php';  // Inclui o footer ?>
