<?php
if (!property_exists($data, 'category')) { //is the cat name provided? I guess we're about to find out!!
    missingParams();
} else {
    $cat->name = $data->category;
    if ($cat->create()) {
        echo json_encode(
            array(
                'id' => $cat->id,
                'category' => $cat->name,
            )
        );
    } else {
        fail("Category", "Created");
    }
}
exit();
?>