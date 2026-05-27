<?php
function connectDB() {
    $url = getenv('DATABASE_URL');
    if (!$url) {
        die("DATABASE_URL not set");
    }
    
    $parts = parse_url($url);
    $host = $parts['host'];
    $port = $parts['port'] ?? 5432;
    $dbname = ltrim($parts['path'], '/');
    $user = $parts['user'];
    $pass = $parts['pass'];
    
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
    
    try {
        $pdo = new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
        return $pdo;
    } catch (PDOException $e) {
        die("DB connection failed: " . $e->getMessage());
    }
}

$pdo = connectDB();
