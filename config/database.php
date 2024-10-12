<?php
$host = 'localhost';
$dbname = 'maisbaru_reserva';
$username = 'maisbaru_reserva';
$password = 'R3s3rva10';


try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Falha na conexão com o banco de dados: " . $e->getMessage());
}
?>