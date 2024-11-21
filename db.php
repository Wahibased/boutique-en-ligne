<?php
$dbHost = 'c8lj070d5ubs83.cluster-czrs8kj4isg7.us-east-1.rds.amazonaws.com',
$dbUser = 'ufjoi2ois2rh6h',
$dbName = 'd73ivujlhosr3k',
$dbPassword='pbcceb270079d474c77cd60d93c199d0ffdf4bf89a7399ffe50009bc6b89ad766',
$dbPort = '5432',
$dbPath ='',



$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}

