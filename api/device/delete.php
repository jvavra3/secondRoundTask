<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods');

include_once '../../database/database.php';
include_once '../../models/device.php';

// inicializace DB připojení
$database = new Database();
$db = $database->connect();

// inicializace třídy device
$device = new Device($db);

// získání dat
$data = json_decode(file_get_contents("php://input"));

// id pro vymazání
$device->id = $data->id;

// vymazání
if ($device->delete_device()) {
    echo json_encode(
        array('message' => 'Smazaný záznam')
    );
} else {
    echo json_encode(
        array('message' => 'Záznam není smazán')
    );
}
