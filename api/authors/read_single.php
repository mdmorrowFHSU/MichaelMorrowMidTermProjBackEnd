<?php
if (isValid($_GET['id'], $theAuthor)) { //making sure its valid then set obj to id
    $author_arr = array(
        'id' => $theAuthor->id,
        'author' => $theAuthor->name
    );
    // turn to JSON
    echo json_encode($author_arr);
} else {
    notFound("author");
}

?>
