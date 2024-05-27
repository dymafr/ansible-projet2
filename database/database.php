<?php

$dns = 'mysql:host=' . getenv('DB_HOST') . ';dbname=' . getenv('DB_NAME');
$user = getenv('DB_USER');
$pwd = getenv('DB_PASSWORD');

try {
    $pdo = new PDO($dns, $user, $pwd, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    echo "ERROR : " . $e->getMessage();
}

return $pdo;
