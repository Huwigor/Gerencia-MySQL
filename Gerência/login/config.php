<?php
$host = 'localhost';
$db   = 'gerencia';
$user = 'root';
$pass = 'bakuri78';

$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $user, $pass);
} catch (PDOException $e) {
    die('Erro na conexão com o banco de dados: ' . $e->getMessage());
}