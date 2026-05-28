<?php
session_start();

// Allowed pages in dashboard
$routes = [
    '' => 'account.php',
    'account' => 'account.php',
    'deposit' => 'deposit.php',
    'forgot' => 'forgot.php',
    'history' => 'history.php',
    'info' => 'info.php',
    'login' => 'login.php',
    'logout' => 'logout.php',
    'payment' => 'payment.php',
    'register' => 'register.php',
    'settings' => 'settings.php',
    'transaction' => 'transaction.php',
    'upgrade' => 'upgrade.php',
    'withdraw' => 'withdraw.php',
];

// Get URI and strip Dashboard/ prefix
$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$uri = preg_replace('#^Dashboard/#i', '', $uri);

if (isset($routes[$uri])) {
    $file = __DIR__. '/'. $routes[$uri];
    if (file_exists($file)) {
        require $file;
        exit;
    }
}

http_response_code(404);
echo '404 - Page Not Found';
