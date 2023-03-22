<?php
    // finding id in database
    if (isvalid($data->id, $quo)) {
        if ($quo->delete()) {
            echo json_encode(
                array(
                    'id' => $data->id
                )
            );
        } else {
            fail("Quote", "Deleted");
        }
    } else {
        echo json_encode(
            array('message' => 'No Quotes Found')
        );
    }
exit();
?>