<?php
// Defina a senha que deseja criptografar
$password = 'tudonosso';

// Use a função password_hash() para gerar a senha criptografada
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Exibir a senha criptografada
echo $hashed_password;
?>
