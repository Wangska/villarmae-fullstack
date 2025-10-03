<?php
// Database configuration using environment variables
$host = $_ENV['DB_HOST'] ?? 'scsok4o44go4owco408ggocc';
$dbname = $_ENV['DB_DATABASE'] ?? 'default';
$username = $_ENV['DB_USERNAME'] ?? 'root';
$password = $_ENV['DB_PASSWORD'] ?? 'p4j7AYzUO0bFC8sAgdGgYb2wKkzZzkGPYfy2Dk9hxUZKDSC1eEVDCVmjZklPjSGI';
$port = $_ENV['DB_PORT'] ?? '3306';

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
