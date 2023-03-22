<?php
    // create the right objects
    $auth = new Author($db);
    $cat = new Category($db);
    //retrieve author_id & category_id in db
    if (!isValid($data->author_id, $auth)) {
        notFound("author");
    } else if (!isValid($data->category_id, $cat)) {
        notFound("category");
    } else {
        $quo->quote = $data->quote;
        $quo->author_id = $data->author_id;
        $quo->category_id = $data->category_id;

        if ($quo->create()) {
            echo json_encode(
                array(
                    'id' => $quo->id,
                    'quote' => $quo->quote,
                    'author_id' => $quo->author_id,
                    'category_id' => $quo->category_id
                )
            );
        } else {
            fail("Quote", "Created");
        }
    }
exit();

