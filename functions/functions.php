<?php
// JSON echo for uncompleted ops
function fail(string $modelType, string $op) {
    echo json_encode(
        array('message' => $modelType . " NOT " . $op)
    );
}

function isValid($id, $model){ //for finding the id and making sure its valid
    $model->id = $id; //sets model to id
    $model->read_single(); //reads the database id
    $className = get_class($model);
    if ($className === "Category" || $className == "Author") {
        return $model->name;
    } else if ($className === "Quote") {
        return ($model->quote);
    } //returns boolean depending on if found or not
}

// when parameters might be missing
function missingParams() {
    echo json_encode(
        array('message' => 'Missing Required Parameters')
    );
}

// JSON echo for no id in db
function notFound($modelType) {
    echo json_encode(
        array('message' => $modelType . 'Id Not Found')
    );
}

// JSON echo for success
function success($modelType, $op) {
    echo json_encode(
        array("message" => $modelType . " " . $op)
    );
}