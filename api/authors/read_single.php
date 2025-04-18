<?php
// Headers



// Instantiate DB & connect


// Instantiate author object
$author = new Author($db);

// Get ID
$author->id = isset($_GET['id']) ? $_GET['id'] : die();

// Get author details
if ($author->read_single()) {
    // Create array
    $author_array = array(
        'id' => $author->id,
        'author' => $author->author 
    );

    // Make JSON
    echo json_encode($author_array);
} else {
    // If no author found
    echo json_encode(array('message' => 'author_id Not Found'));
}
?>