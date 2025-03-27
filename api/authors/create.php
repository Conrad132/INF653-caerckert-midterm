<?php
// Headers




// Instantiate DB & connect


// Instantiate author object


// Get raw data from POST request
$data = json_decode(file_get_contents("php://input"));

// Check for missing parameters (except 'id')
if (!isset($data->author)) {
    echo json_encode(array('message' => 'Missing Required Parameters'));
    exit();
}

// Set author details
$author->author = $data->author;

// Create author
if ($author->create()) {
    echo json_encode(array(
        'id' => $author->id, 
        'author' => $author->author
    ));
} else {
    echo json_encode(array('message' => 'author_id Not Found'));
}
?>