<?php
$host = 'localhost';
$db   = 'todo_list';
$user = 'root';
$pass = 'Maria@2005';
$charset = 'utf8mb4';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=$charset", $user, $pass);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}
?>