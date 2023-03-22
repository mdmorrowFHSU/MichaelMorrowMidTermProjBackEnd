<?php

// query the author
$result = $theAuthor->read();

// retrieve row count
$rowCount = $result->rowCount();

// json message for empty query
if ($rowCount == 0) {
    echo json_encode(
        array('message' => 'No authors found.')
    );
} else {
    
    $authors_arr = array();
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $author_item = array(
            'id' => $id,
            'author'=> $author
        );

        array_push($authors_arr, $author_item);      
    }
    // output in JSON
    echo json_encode($authors_arr);
}
