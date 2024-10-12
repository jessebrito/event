<?php
session_start();
session_destroy();  // Destrói a sessão do administrador
header('Location: admin_login.php');  // Redireciona para a página de login do administrador
exit;
?>
