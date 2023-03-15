<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods');

include_once '../../database/database.php';
include_once '../../models/location.php';




// inicializace DB připojení
$database = new Database();
$db = $database->connect();

// inicializace třídy location
$location = new Location($db);



// získání dat
$data = json_decode(file_get_contents("php://input"));


$location->nazev = $data->nazev;
$location->poznamka = $data->poznamka;
$location->gps = $data->gps;



if ($location->create_location()) {
    echo json_encode(
        array('message' => 'Byl vytvořen záznam v tabulce lokace')
    );
} else {
    echo json_encode(
        array('message' => 'Nebyl vytvořen záznam v tabulce lokace')
    );
}
