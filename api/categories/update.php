<?php
if (!property_exists($data, 'id') || !property_exists($data, 'category')) { //checking for params again
    missingParams();
} else {

    if (isValid($data->id, $cat)) { //checking for cat id in database
        $cat->name = $data->category; //update the cat
        if ($cat->update()) { 
            echo json_encode(
                array(
                    'id' => $cat->id,
                    'category' => $cat->name,
                )
            );
        } else {
            fail("Category", "Updated");
        }
    } else {
        notFound("category");
    }    
}
exit();
?>