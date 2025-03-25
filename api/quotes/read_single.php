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
    if ($quote->read_single()) {
        echo json_encode(array(
            'id' => $quote->id,
            'quote' => $quote->quote,
            'author' => $quote->author_name,
            'category' => $quote->category_name
        ));
    } else {
        http_response_code(200);
        echo json_encode(array('message' => 'No Quotes Found'));
    }
}
?>