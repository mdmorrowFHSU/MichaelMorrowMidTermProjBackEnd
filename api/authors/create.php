<?php
if (!property_exists($data, "author")) { //making sure prop exists
    missingParams();
} else {
    $theAuthor->name = $data->author;
    if ($theAuthor->create()) {
        echo json_encode(
            array(
                'id' => $theAuthor->id,
                'author' => $theAuthor->name
            )
        );
    } else {
        fail("Author", "Created");
    }
}

exit();

?>