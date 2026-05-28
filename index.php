<?php
session_start();

$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

switch ($uri) {

    case '':
    case 'home':
        require __DIR__. '/home.php';
        break;

    case 'about':
        require __DIR__. '/about.php';
        break;

    case 'terms':
        require __DIR__. '/terms.php';
        break;

    case 'privacy':
        require __DIR__. '/privacy.php';
        break;

    case 'faq':
        require __DIR__. '/faq.php';
        break;

    case 'contact':
        require __DIR__. '/contact.php';
        break;

    case 'login':
        require __DIR__. '/Dashboard/login.php';
        break;

    case 'register':
        require __DIR__. '/Dashboard/register.php';
        break;

    case 'Dashboard':
    case 'dashboard':
        // Delegate to dashboard router
        require __DIR__. '/Dashboard/index.php';
        break;

    default:
        http_response_code(404);
        echo '404 - Page Not Found';
        break;
}
