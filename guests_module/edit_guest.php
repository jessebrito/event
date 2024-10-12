<?php
include '../config/database.php';
include 'GuestManager.php';

$guestManager = new GuestManager($pdo);
$guest_id = $_GET['guest_id'] ?? null;
$guest = $guestManager->getGuestsByReservation($guest_id)[0];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $guestManager->editGuest($guest_id, $_POST['name'], $_POST['phone'], $_POST['email'], isset($_POST['is_accompanied']) ? 1 : 0);
    header("Location: guest_form.php?reservation_id=" . $_GET['reservation_id']);
    exit;
}

include '../templates/header.php';
?>

<h2>Editar Convidado</h2>

<form method="POST">
    <div class="form-group">
        <label>Nome do Convidado:</label>
        <input type="text" name="name" class="form-control" value="<?php echo $guest['name']; ?>" required>
    </div>
    <div class="form-group">
        <label>Telefone:</label>
        <input type="text" name="phone" class="form-control" value="<?php echo $guest['phone']; ?>" required>
    </div>
    <div class="form-group">
        <label>E-mail:</label>
        <input type="email" name="email" class="form-control" value="<?php echo $guest['email']; ?>" required>
    </div>
    <div class="form-group">
        <label>Vai acompanhado?</label>
        <input type="checkbox" name="is_accompanied" <?php echo $guest['is_accompanied'] ? 'checked' : ''; ?>>
    </div>
    <button type="submit" class="btn btn-primary">Salvar</button>
</form>

<?php include '../templates/footer.php'; ?>
