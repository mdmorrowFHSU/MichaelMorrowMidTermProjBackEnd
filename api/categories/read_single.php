<?php
if (isValid($_GET['id'], $cat)) { //same at author api
    $cat_arr = array(
        'id' => $cat->id,
        'category' => $cat->name
    );
    echo json_encode($cat_arr);
} else {
    notFound("category");
}
?>
