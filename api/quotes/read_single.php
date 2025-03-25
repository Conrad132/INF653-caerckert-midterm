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

// Get the quote data
if ($quote->read_single()) {
    // Quote found
    echo json_encode(array(
        'id' => $quote->id,
        'quote' => $quote->quote,
        'author' => $quote->author_name,
        'category' => $quote->category_name
    ));
    } else {
        // No quote found, return valid JSON
        http_response_code(404);
        echo json_encode(array('message' => 'No Quotes Found'));
}

?>