<?php
// Headers



// Instantiate DB & connect


// Instantiate author object


// Get raw data from PUT request
$data = json_decode(file_get_contents("php://input"));

// Check for missing parameters (except 'id')
if (!isset($data->id) || !isset($data->author)) {
    echo json_encode(array('message' => 'Missing Required Parameters'));
    exit();
}

// Set author details
$author->id = $data->id;
$author->author = $data->author;

// Update author
if ($author->update()) {
    echo json_encode(array('id' => $author->id, 'author' => $author->author));
} else {
    echo json_encode(array('message' => 'author_id Not Found'));
}
?>