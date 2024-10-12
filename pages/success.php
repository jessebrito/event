<?php
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

include '../templates/header.php';
?>

<h2>Comprovante Enviado com Sucesso!</h2>
<p>Seu comprovante foi enviado com sucesso. A equipe da ONG irá revisar o pagamento em breve. Você será notificado assim que o pagamento for aprovado.</p>

<a href="dashboard.php" class="btn btn-primary">Voltar para o Dashboard</a>

<?php include '../templates/footer.php'; ?>
