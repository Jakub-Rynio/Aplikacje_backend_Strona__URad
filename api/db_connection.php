<?php
$host = 'localhost';       // lub nazwa serwera
$db   = 'przepisy';
$user = 'przepisy_db';
$pass = '!QAZ2wsx';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,  // wyjątki przy błędach
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,        // fetch jako tablica asocjacyjna
    PDO::ATTR_EMULATE_PREPARES   => false,                   // prawdziwe prepared statements
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    // w produkcji lepiej logować niż wyświetlać
    exit('Błąd połączenia z bazą: ' . $e->getMessage());
}
