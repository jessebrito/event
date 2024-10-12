<?php
$host = 'localhost';
$dbname = 'maisbaru_reserva';
$username = 'maisbaru_reserva';
$password = 'On102030';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>