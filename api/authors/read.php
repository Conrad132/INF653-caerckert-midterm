<?php
    // Headers



    // Instantiate DB & connect


    // Instantiate author object


    // Fetch all authors
    $result = $author->read();
    // Get row count
    $num = $result->rowCount();

    // Check if any authors
    if ($num > 0) {
        $authors_arr = [];
    
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $authors_arr[] = array(
                'id' => $id,
                'author' => $author 
            );
        }
    
        // Output as JSON array
        echo json_encode($authors_arr);
    } else {
        // No authors found
        echo json_encode(
            array('message' => 'No Authors Found')
        );
        }
    
?>