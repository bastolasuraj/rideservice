<?php
$hostname = "localhost";
$username = "sbastola_itil";
$password = "eu9MB6!fh2@ITIL";
$database = "sbastola_itil";

try {
    $pdo = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>
