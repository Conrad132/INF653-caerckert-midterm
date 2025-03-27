<?php
// Headers



// Instantiate DB & connect


// Instantiate author object
$author = new Author($db);

// Get raw data from DELETE request
$data = json_decode(file_get_contents("php://input"));

// Check for missing id
if (!isset($data->id)) {
    echo json_encode(array('message' => 'No Authors Found'));
    exit();
}

// Set author id
$author->id = $data->id;

// Delete author
if ($author->delete()) {
    echo json_encode(array('id' => $author->id));
} else {
    echo json_encode(array('message' => 'No Authors Found'));
}
?>