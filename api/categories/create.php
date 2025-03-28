<?php
// Headers



// Instantiate DB & connect


// Instantiate category object


// Get raw data from POST request
$data = json_decode(file_get_contents("php://input"));

// Check for missing parameters (except 'id')
if (!isset($data->category)) {
    echo json_encode(array('message' => 'Missing Required Parameters'));
    exit();
}

// Set category details
$category->category = $data->category;

// Create category
if ($category->create()) {
    echo json_encode(array(
        'id' => $category->id, 
        'category' => $category->category
    ));
} else {
    echo json_encode(array('message' => 'category_id Not Found'));
}
?>