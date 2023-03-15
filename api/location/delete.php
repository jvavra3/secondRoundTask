<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods');

include_once '../../database/database.php';
include_once '../../models/location.php';

// inicializace DB připojení
$database = new Database();
$db = $database->connect();

// inicializace třídy content
$location = new Location($db);

// získání dat
$data = json_decode(file_get_contents("php://input"));

// id pro vymazání
$location->id = $data->id;

// vymazání
if ($location->delete_location()) {
    echo json_encode(
        array('message' => 'Smazaný záznam')
    );
} else {
    echo json_encode(
        array('message' => 'Záznam není smazán')
    );
}
