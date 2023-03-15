<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
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

// spárování dat
$location->id = $data->id;

$location->nazev = $data->nazev;
$location->poznamka = $data->poznamka;
$location->gps = $data->gps;



if ($location->update_location()) {
    echo json_encode(
        array('message' => 'Záznam aktualizován')
    );
} else {
    echo json_encode(
        array('message' => 'Záznam není aktualizován')
    );
}
