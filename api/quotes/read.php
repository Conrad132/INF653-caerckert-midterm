<?php

// Headers




// Instantiate DB & connect


// Instantiate Quote object


// Blog quote query
$result = $quote->read();
// Get row count
$num = $result->rowCount();

// Check if any Quotes exist
if ($num > 0) {
    // Quote array
    $quotes_arr = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
    
        $quote_item = array(
            'id' => isset($id) ? $id : null,
            'quote' => isset($quote) ? html_entity_decode($quote) : null,
            'author' => isset($author_name) ? $author_name : 'Unknown Author',
            'category' => isset($category_name) ? $category_name : 'Uncategorized'
        );
    
        array_push($quotes_arr, $quote_item);
    }

    // output JSON
    echo json_encode($quotes_arr);
} else {
    // No Quotes Found - Return an empty array
    echo json_encode(array('message' => 'No Quotes Found'));
}
?>