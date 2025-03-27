<?php
// Headers


// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate quote object
$quote = new Quote($db);

// Get raw data from DELETE request
$data = json_decode(file_get_contents("php://input"));

// Check for missing id
if (!isset($data->id)) {
    echo json_encode(array('message' => 'No Quotes Found'));
    exit();
}

// Set quote id
$quote->id = $data->id;

// Delete quote
if ($quote->delete()) {
    echo json_encode(array('id' => $quote->id));
} else {
    echo json_encode(array('message' => 'No Quotes Found'));
}
?>