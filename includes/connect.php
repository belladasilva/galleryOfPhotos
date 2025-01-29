<?php
$servername = "localhost";
$username = "root";
$password = "Italo@071010";
$myDB = "gallery";
$port = 3306;

try {
    $pdo = new PDO("mysql:host=$servername;port=$port;dbname=$myDB", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
