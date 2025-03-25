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
    $quote->read_single();

    if ($quote->quote) {
        $quote_array = array(
            'id' => $quote->id, 
            'quote' => $quote->quote,  
            'author' => $quote->author_name,  
            'category' => $quote->category_name,  
        );
        echo json_encode($quote_array);
    } else {
        // Return an error if no quote found
        echo json_encode(array('message' => 'No Quotes Found'));
    }
} else {
    // Handle case where ID is not provided or invalid
    echo json_encode(array('message' => 'Invalid or missing ID'));
}
?>