<?php
$dbhost = 'localhost';
$dbname = 'u_230090284_db';
$username = 'u-230090284';
$password = 'Ac5aR4bHgHlRfxs';

$dsn = "mysql:host=$dbhost;dbname=$dbname;charset=utf8mb4";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
