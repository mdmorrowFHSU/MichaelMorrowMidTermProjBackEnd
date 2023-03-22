<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
//file linked to CRUD 
include_once '../../config/Database.php';
include_once '../../models/Author.php';
include_once '../../functions/functions.php';
include_once '../../models/Category.php';
include_once '../../models/Quote.php';


//provided by instructor
$method = $_SERVER['REQUEST_METHOD'];
if ($method === 'OPTIONS') {
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
}

// instantiation of DB Object and then connect
$database = new Database();
$db = $database->connect();

// instantiation of author object
$theAuthor = new Author($db);

// using raw data from user in postman
$data = json_decode(file_get_contents('php://input'));

// switch statement to use the right file for GET, PUT, POST, DELETE
switch ($method) {
    case 'GET': isset($_GET['id']) ? require 'read_single.php' : require 'read.php'; break;
    case 'PUT': require 'update.php'; break;
    case 'POST': require 'create.php'; break;
    case 'DELETE': require 'delete.php'; break;
}

?>