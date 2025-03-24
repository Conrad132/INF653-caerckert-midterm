<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Quote.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate quote object
$quote = new Quote($db);

// Get ID from URL
$quote->id = isset($_GET['id']) ? $_GET['id'] : die();

// Get quote
$quote->read_single();

// Create an array with the data
$quote_array = array(
    'id' => $quote->id, 
    'quote' => $quote->quote,  // Assuming 'quote' is the field in your Quote class
    'author' => $quote->author_name,  // Assuming 'author_name' is set in your class
    'category' => $quote->category_name,  // Assuming 'category_name' is set in your class
);

// Return JSON response
echo json_encode($quote_array);
?>