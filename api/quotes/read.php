<?php
//have to figure out is 1 or both is being queried
$data = $_GET;
if (isset($data['author_id'])) { //making sure auth id is there
    $quo->author_id = $data['author_id'];

    if (isset($data['category_id'])) { //making sure cat id is there
        $quo->category_id = $data['category_id'];
        $result = $quo->read_author_and_category();
    } else {
        $result = $quo->read_author(); //for only auth id user enters
    }
} else if (isset($data['category_id'])) { //for only cat id user enters
    $quo->category_id = $data['category_id'];
    $result = $quo->read_category();
} else {
    $result = $quo->read(); //return all if not specified
}

// retrieving row count
$rowCount = $result->rowCount();

if ($rowCount == 0) {
    echo json_encode(
        array('message' => 'No Quotes Found.') // JSON echo for none found
    );
} else {
    $quotes_arr = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $quote_item = array(
            'id' => $id,
            'quote' => $quote,
            'author' => $author,
            'category' => $category
        );
        array_push($quotes_arr, $quote_item); //pushing data array
    }
    echo json_encode($quotes_arr); //JSON output for array
}
