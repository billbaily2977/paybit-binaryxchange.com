<?php
function connectDB() {
    $url = getenv('DATABASE_URL');
    if (!$url) {
        die("DATABASE_URL not set");
    }
    try {
        $pdo = new PDO($url, null, null, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
        return $pdo;
    } catch (PDOException $e) {
        die("DB connection failed: " . $e->getMessage());
    }
}

$pdo = connectDB();
