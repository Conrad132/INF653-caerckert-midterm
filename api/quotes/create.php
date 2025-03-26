<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,
Access-Control-Allow-Methods,Authorization,X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Quote.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate Quote object
$quote = new Quote($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Validate input
if (!isset($data->quote, $data->author_id, $data->category_id)) {
    http_response_code(400);
    echo json_encode(array('message' => 'Missing Required Parameters'));
    exit;
}

// Assign values
$quote->quote = htmlspecialchars(strip_tags($data->quote));
$quote->author_id = (int) $data->author_id;  // Ensure integer type
$quote->category_id = (int) $data->category_id;  // Ensure integer type

// Create Quote
if ($quote->create()) {
    // Return the newly created quote with its ID
    echo json_encode([
        'id' => $quote->id,  // Fetching last inserted ID
        'quote' => $quote->quote,
        'author_id' => $quote->author_id,
        'category_id' => $quote->category_id
    ]);
} else {
    echo json_encode(array('message' => 'Quote Not Created'));
}
?>