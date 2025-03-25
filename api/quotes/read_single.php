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
if ($quote->id) {
    $quote_data = $quote->read_single();

if ($quote_data) {
    // Create an array with the data
    $quote_array = array(
            'id' => $quote->id, 
            'quote' => $quote->quote,  
            'author' => $quote->author_name,  
            'category' => $quote->category_name,  
        );
 
        // Set response code and return JSON
        echo json_encode($quote_array);
        } else {
        // No Quote Found - Return a valid JSON response
        echo json_encode(array('message' => 'No quote found.'));
    }
}
?>