<?php
session_start();
include '../config/database.php';  // Inclua o arquivo de conexão com o banco de dados

// Verificar se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Obter o ID do usuário logado
$user_id = $_SESSION['user_id'];

// Obter informações do usuário e das reservas
$stmt = $pdo->prepare("SELECT * FROM reservations WHERE user_id = ?");
$stmt->execute([$user_id]);
$reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);

include '../templates/header.php';
?>

<h2>Suas Reservas</h2>

<?php if (count($reservations) > 0): ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID da Reserva</th>
                <th>Data da Reserva</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reservations as $reservation): ?>
                <tr>
                    <td><?php echo $reservation['id']; ?></td>
                    <td><?php echo date('d/m/Y', strtotime($reservation['reserved_date'])); ?></td>  <!-- Alteração para formato brasileiro -->
                    <td><?php echo $reservation['status']; ?></td>
                   <td> <?php if ($reservation['status'] == 'confirmada'): ?>
    <a href="../guests_module/guest_form.php?reservation_id=<?php echo $reservation['id']; ?>" class="btn btn-primary">Gerenciar Lista de Convidados</a>
<?php endif; ?></td>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>Você ainda não fez nenhuma reserva.</p>
<?php endif; ?>

<?php include '../templates/footer.php'; ?>
