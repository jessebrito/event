<?php
session_start();
include '../config/database.php';
include 'GuestManager.php';

// Instanciando o gerenciador de convidados
$guestManager = new GuestManager($pdo);

// Pegando o ID da reserva (evento)
$reservation_id = $_GET['reservation_id'] ?? null;

if (!$reservation_id) {
    die('ID da reserva não foi fornecido.');
}

// Verificar se o usuário está logado
$user_logged_in = isset($_SESSION['user_id']);

// Verificar se o usuário atual é o dono da reserva
$is_owner = false;

if ($user_logged_in) {
    $stmt = $pdo->prepare("SELECT user_id FROM reservations WHERE id = ?");
    $stmt->execute([$reservation_id]);
    $reservation = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Verifica se o usuário logado é o dono da reserva
    if ($reservation && $reservation['user_id'] == $_SESSION['user_id']) {
        $is_owner = true;
    }
}

$guests = $guestManager->getGuestsByReservation($reservation_id);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $is_owner) {
    // Adiciona o convidado ao evento
    $guestManager->addGuest(
        $reservation_id,
        $_POST['name'],
        $_POST['phone'],
        $_POST['email'],
        isset($_POST['is_accompanied']) ? 1 : 0
    );
    header("Location: guest_form.php?reservation_id=$reservation_id");
    exit;
}

include '../templates/header.php';
?>

<h2>Confirme sua Presença</h2>


    <form method="POST">
        <div class="form-group">
            <label>Nome:</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Telefone:</label>
            <input type="text" name="phone" class="form-control" required>
        </div>
        <div class="form-group">
            <label>E-mail:</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Vai acompanhado?</label>
            <input type="checkbox" name="is_accompanied">
        </div>
        <button type="submit" class="btn btn-primary">Confirmar presença</button>
    </form>
 <?php if ($is_owner): ?>

<h3>Lista de Convidados</h3>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Telefone</th>
            <th>E-mail</th>
            <th>Vai acompanhado?</th>
            <?php if ($is_owner): ?> <!-- Exibe as ações somente para o dono -->
                <th>Ações</th>
            <?php endif; ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($guests as $guest): ?>
            <tr>
                <td><?php echo $guest['name']; ?></td>
                <td><?php echo $guest['phone']; ?></td>
                <td><?php echo $guest['email']; ?></td>
                <td><?php echo $guest['is_accompanied'] ? 'Sim' : 'Não'; ?></td>
                <?php if ($is_owner): ?> <!-- Exibe as ações somente para o dono -->
                    <td>
                        <a href="edit_guest.php?guest_id=<?php echo $guest['id']; ?>&reservation_id=<?php echo $reservation_id; ?>" class="btn btn-primary">Editar</a>
                        <a href="remove_guest.php?guest_id=<?php echo $guest['id']; ?>&reservation_id=<?php echo $reservation_id; ?>" class="btn btn-danger">Remover</a>
                    </td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php endif; ?>
<!-- Exibe o botão de compartilhar via WhatsApp somente para o dono -->
<?php if ($is_owner): ?>
    <?php $whatsappLink = $guestManager->generateWhatsAppLink($reservation_id); ?>
    <a href="<?php echo $whatsappLink; ?>" class="btn btn-success">Compartilhar Lista de Convidados via WhatsApp</a>
<?php endif; ?>

<?php include '../templates/footer.php'; ?>
