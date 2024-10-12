<?php
session_start();

// Exibir o menu baseado no tipo de usuário (usuário comum ou administrador)
if (isset($_SESSION['admin_id'])) {
    // Menu para o administrador
    echo '
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Admin Panel</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link" href="/reserva/admin/admin_dashboard.php">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="/reserva/admin/export_users.php">Exportar Usuários</a></li>
                <li class="nav-item"><a class="nav-link" href="/reserva/admin/admin_logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>';
} elseif (isset($_SESSION['user_id'])) {
    // Menu para o usuário comum
    echo '
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Usuário</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link" href="/reserva/reserve.php">Reservar</a></li>
                <li class="nav-item"><a class="nav-link" href="/reserva/dashboard.php">Minhas Reservas</a></li>
                <li class="nav-item"><a class="nav-link" href="/reserva/logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>';
} else {
    // Menu para visitantes não logados (opcional)
    echo '
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">ONG Reservas</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link" href="/reserva/login.php">Login</a></li>
                <li class="nav-item"><a class="nav-link" href="/reserva/register.php">Registrar</a></li>
            </ul>
        </div>
    </nav>';
}
?>
