<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods');

include_once '../../database/database.php';
include_once '../../models/distribution.php';

// inicializace DB připojení
$database = new Database();
$db = $database->connect();

// inicializace třídy content
$distribution = new Distribution($db);

// získání dat
$data = json_decode(file_get_contents("php://input"));

// spárování dat
$distribution->id = $data->id;

$distribution->obsah = $data->obsah;
$distribution->zarizeni = $data->zarizeni;
$distribution->cas_distribuce = $data->cas_distribuce;



if ($distribution->update_distribution()) {
    echo json_encode(
        array('message' => 'Záznam aktualizován')
    );
} else {
    echo json_encode(
        array('message' => 'Záznam není aktualizován')
    );
}
