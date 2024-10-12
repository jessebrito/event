<?php
// Verificar se a sessão já está ativa antes de chamar session_start()
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css" rel="stylesheet">
    <title>ONG Reservas</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/evento">ONG Reservas</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <?php if (isset($_SESSION['admin_id'])): ?>
                <!-- Menu para Administrador -->
                <li class="nav-item"><a class="nav-link" href="/evento/admin/admin_dashboard.php">Dashboard Admin</a></li>
                <li class="nav-item"><a class="nav-link" href="/evento/admin/export_users.php">Exportar Usuários</a></li>
                <li class="nav-item"><a class="nav-link" href="/evento/admin/admin_logout.php">Logout</a></li>
            <?php elseif (isset($_SESSION['user_id'])): ?>
                <!-- Menu para Usuário Comum -->
                <li class="nav-item"><a class="nav-link" href="/evento/pages/reserve.php">Reservar</a></li>
                <li class="nav-item"><a class="nav-link" href="/evento/pages/dashboard.php">Minhas Reservas</a></li>
                <li class="nav-item"><a class="nav-link" href="/evento/pages/logout.php">Logout</a></li>
            <?php else: ?>
                <!-- Menu para Visitantes -->
                <li class="nav-item"><a class="nav-link" href="/evento/pages/login.php">Login</a></li>
                <li class="nav-item"><a class="nav-link" href="/evento/pages/register.php">Registrar</a></li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
<div class="container">
