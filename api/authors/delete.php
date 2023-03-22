<?php
if (!property_exists($data, "id")) { //make sure prop exists
    missingParams();
} else {
    if (isValid($data->id, $theAuthor)) { //find the id, make sure its valid
        if ($theAuthor->delete()) {
            echo json_encode(
                array(
                    'id' => $data->id
                )
            );
        } else {
            fail("Author", "Deleted");
        }
    } else {
        notFound("author");
    }
    
}

exit();