<?php
session_start();
include '../config/database.php';

// Verificar se o administrador está logado
if (!isset($_SESSION['admin_id'])) {
    header('Location: admin_login.php');
    exit;
}

// Definir o cabeçalho do arquivo CSV
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=usuarios.csv');

// Abrir a saída em modo de escrita
$output = fopen('php://output', 'w');

// Escrever a linha de cabeçalho
fputcsv($output, array('ID', 'Nome', 'E-mail'));

// Buscar dados dos usuários
$stmt = $pdo->prepare("SELECT id, name, email FROM users");
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Escrever cada linha no CSV
foreach ($users as $user) {
    fputcsv($output, $user);
}

fclose($output);
?>
