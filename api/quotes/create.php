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

// Instantiate Quote, 
$quote = new Quote($db);


// Get raw POST data
$data = json_decode(file_get_contents("php://input"));

// Check if required parameters are missing
if (!isset($data->quote) || !isset($data->author_id) || !isset($data->category_id)) {
    echo json_encode(array('message' => 'Missing Required Parameters'));
    
    exit();
}

// Set quote details
$quote->quote = $data->quote;
$quote->author_id = $data->author_id;
$quote->category_id = $data->category_id;

// Create quote
if ($quote->create()) {
    echo json_encode(array(
        'id' => $quote->id,
        'quote' => $quote->quote,
        'author_id' => $quote->author_id,
        'category_id' => $quote->category_id
    ));
    
} else {
    echo json_encode(array('message' => 'Quote Not Created'));
    
}
?>