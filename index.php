<?php
session_start();

$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

$base = ''; 
if ($base !== '' && strpos($uri, $base) === 0) {
    $uri = substr($uri, strlen($base));
}
$uri = trim($uri, '/');

switch ($uri) {
    
    case '':
    case 'home':
        require __DIR__ . '/home.php';
        break;
        
    case 'about':
        require __DIR__ . '/about.php';
        exit;
        
    case 'terms':
        require __DIR__ . '/terms.php';
        exit;
        
    case 'privacy':
        require __DIR__ . 'privacy.php';
        exit;
        
    case 'faq':
        require __DIR__ . '/faq.php';
        exit;
        
    case 'contact':
        require __DIR__ . '/contact.php';
        exit;
	case 'privacy':
        require __DIR__ . '/privacy.php';
        exit;

    case 'Dashboard/login':
        require __DIR__ . '/Dashboard/login.php';
        exit;
        
    case 'Dashboard/register':
        require __DIR__ . '/Dashboard/register.php';
        exit;
        
    case 'dashboard':
    case 'Dashboard':
        require __DIR__ . '/Dashboard/index.php';
        exit;

    default:
        http_response_code(404);
        echo '404 - Page Not Found';
        exit;
}
