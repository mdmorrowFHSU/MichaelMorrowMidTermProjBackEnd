<?php
if (!property_exists($data, 'id') || !property_exists($data, 'author')) { //making sure props exist
    missingParams();
} else {
    if (isValid($data->id, $theAuthor)) { //finding id in database
        
        $theAuthor->name = $data->author; //updating author
        if ($theAuthor->update()) {
            echo json_encode(
                array(
                    'id' => $theAuthor->id,
                    'author' => $theAuthor->name
                )
            );
        } else {
            fail("Author", "Updated");
        }
    } else {
        notFound("author");
    }    
}
exit();