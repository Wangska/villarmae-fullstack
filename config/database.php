<?php
// Database configuration using environment variables
$host = $_ENV['DB_HOST'] ?? 'joccwsg44gwo0oc0s8g48ko0';
$dbname = $_ENV['DB_DATABASE'] ?? 'default';
$username = $_ENV['DB_USERNAME'] ?? 'root';
$password = $_ENV['DB_PASSWORD'] ?? '0439VpH3ybiZZdDmbFH7mI1PXBBSSGfMwh96BdMEcBGGYH5gJsIFZAiTAfCwNJGz';
$port = $_ENV['DB_PORT'] ?? '3306';

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
