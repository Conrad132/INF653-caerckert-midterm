<?php
// Headers




// Instantiate DB & connect


// Instantiate category object


// Get ID from URL
$category->id = isset($_GET['id']) ? $_GET['id'] : die();

// Fetch category data
$category->read_single();

// Get category details
if ($category->read_single()) {
    echo json_encode(array(
        'id' => $category->id,
        'category' => $category->category
    ));
} else {
    echo json_encode(array('message' => 'category_id Not Found'));
}
?>