<?php
// Headers
 


// Instantiate DB & connect


// Instantiate Quote, Author, Category objects

$author = new Author($db);
$category = new Category($db);

// Get raw data from PUT request
$data = json_decode(file_get_contents("php://input"));

    // Check for missing parameters (except 'id')
    if (!isset($data->id) || !isset($data->quote) || !isset($data->author_id) || !isset($data->category_id)) {
        echo json_encode(array('message' => 'Missing Required Parameters'));
        exit();
    }

    // Validate author_id
    $author->id = $data->author_id;
    if (!$author->findById()) {
        echo json_encode(array('message' => 'author_id Not Found'));
        exit();
    }

    // Validate category_id
    $category->id = $data->category_id;
    if (!$category->findById()) {
        echo json_encode(array('message' => 'category_id Not Found'));
        exit();
    }

    // Check if the quote ID exists before updating
    $quote->id = $data->id;
    if (!$quote->findById()) {  // Implement findById() for Quote
        echo json_encode(array('message' => 'No Quotes Found'));
        exit();
    }

    // Set quote details
    $quote->id = $data->id;
    $quote->quote = $data->quote;
    $quote->author_id = $data->author_id;
    $quote->category_id = $data->category_id;

    // Update quote
    if ($quote->update()) {
        echo json_encode(array('id' => $quote->id, 'quote' => $quote->quote, 'author_id' => $quote->author_id, 'category_id' => $quote->category_id));
    } else {
        echo json_encode(array('message' => 'No Quotes Found'));
    }
    ?>