<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods');

include_once '../../database/database.php';
include_once '../../models/distribution.php';




// inicializace DB připojení
$database = new Database();
$db = $database->connect();

// inicializace třídy distribution
$distribution = new Distribution($db);



// získání dat
$data = json_decode(file_get_contents("php://input"));


$distribution->obsah = $data->obsah;
$distribution->zarizeni = $data->zarizeni;
$distribution->cas_distribuce = $data->cas_distribuce;



if ($distribution->create_distribution()) {
    echo json_encode(
        array('message' => 'Byl vytvořen záznam v tabulce distribuce')
    );
} else {
    echo json_encode(
        array('message' => 'Nebyl vytvořen záznam v tabulce distribuce')
    );
}
