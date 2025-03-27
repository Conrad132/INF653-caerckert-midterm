<?php
// Headers



// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate category object
$category = new Category($db);

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