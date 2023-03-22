<?php

if (isValid($_GET['id'], $quo)) { //setting object to id and retrieving from database
    $quote_arr = array(
        'id' => $quo->id,
        'quote' => $quo->quote,
        'author' => $quo->theAuthor,
        'category' => $quo->theCategory
    );
    
    echo json_encode($quote_arr); // JSON echo the array
} else {
    echo json_encode(
        array('message' => 'No Quotes Found') //JSON echo if not found
    );
}
