<?php
// Headers



// Instantiate DB & connect


// Instantiate category object
$category = new Category($db);

// Get raw data from DELETE request
$data = json_decode(file_get_contents("php://input"));

// Check for missing id
if (!isset($data->id)) {
    echo json_encode(array('message' => 'No Categories Found'));
    exit();
}

// Set category id
$category->id = $data->id;

// Delete category
if ($category->delete()) {
    echo json_encode(array('id' => $category->id));
} else {
    echo json_encode(array('message' => 'No Categories Found'));
}
?>