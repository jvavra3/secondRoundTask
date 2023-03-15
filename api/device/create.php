<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
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


$device->nazev = $data->nazev;
$device->popis = $data->popis;
$device->ip = $data->ip;
$device->uuid = $data->uuid;
$device->lokace_id = $data->lokace_id;
$device->apikey = $data->apikey;




if ($device->create_device()) {
    echo json_encode(
        array('message' => 'Byl vytvořen záznam v tabulce zařízení')
    );
} else {
    echo json_encode(
        array('message' => 'Nebyl vytvořen záznam v tabulce zařízení')
    );
}
