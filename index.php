<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header("Access-Control-Allow-Credentials: true");
header("Strict-Transport-Security: max-age=31536000; includeSubDomains; preload");
header("X-Frame-Options: DENY");
header("X-XSS-Protection: 1; mode=block");
header("X-Content-Type-Options: nosniff");

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'OPTIONS') {
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
    exit();
}

// Load dependencies
require_once __DIR__ . '/config/Database.php';

// Establish database connection
$database = new Database();
$db = $database->connect();

// Handle Routing
$request_uri = strtok($_SERVER['REQUEST_URI'], '?'); // Removes query parameters

if ($request_uri == '/') {
    // Serve the HTML file for the root
    echo file_get_contents(__DIR__ . '/index.html');  
} else {
    // Handle API routes
    switch ($request_uri) {
        case '/api/quotes':
            require 'routes/quotes.php';
            break;
        case '/api/authors':
            require 'routes/authors.php';
            break;
        case '/api/categories':
            require 'routes/categories.php';
            break;
        default:
            echo file_get_contents(__DIR__ . '/index.html');  
            break;
    }
}
?>