<?php
session_start();
include '../config/database.php';

// Verificar se o administrador está logado
if (!isset($_SESSION['admin_id'])) {
    header('Location: admin_login.php');
    exit;
}

// Lógica para adicionar uma nova data
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['new_date'])) {
    $new_date = $_POST['new_date'];

    // Inserir a nova data no banco de dados
    $stmt = $pdo->prepare("INSERT INTO admin_reserved_dates (reserved_date) VALUES (?)");
    $stmt->execute([$new_date]);

    header('Location: admin_dates.php');
    exit;
}

// Lógica para remover uma data reservada
if (isset($_GET['delete_date'])) {
    $date_id = $_GET['delete_date'];

    // Remover a data reservada do banco de dados
    $stmt = $pdo->prepare("DELETE FROM admin_reserved_dates WHERE id = ?");
    $stmt->execute([$date_id]);

    header('Location: admin_dates.php');
    exit;
}

// Buscar todas as datas reservadas pelo administrador
$stmt = $pdo->prepare("SELECT * FROM admin_reserved_dates ORDER BY reserved_date");
$stmt->execute();
$reserved_dates = $stmt->fetchAll(PDO::FETCH_ASSOC);

include '../templates/header.php';  // Inclui o header
?>

<h2>Gerenciar Datas Reservadas</h2>

<!-- Formulário para adicionar novas datas -->
<form action="admin_dates.php" method="POST">
    <div class="form-group">
        <label for="new_date">Adicionar nova data reservada:</label>
        <input type="date" class="form-control" id="new_date" name="new_date" required>
    </div>
    <button type="submit" class="btn btn-primary">Adicionar Data</button>
</form>

<h3>Datas já reservadas:</h3>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Data Reservada</th>
            <th>Ação</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($reserved_dates as $date): ?>
            <tr>
                <td><?php echo $date['reserved_date']; ?></td>
                <td>
                    <a href="admin_dates.php?delete_date=<?php echo $date['id']; ?>" class="btn btn-danger">Remover</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include '../templates/footer.php';  // Inclui o footer ?>
