<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods');

include_once '../../database/database.php';
include_once '../../models/content.php';

// inicializace DB připojení
$database = new Database();
$db = $database->connect();

// inicializace třídy content
$content = new Content($db);

// získání dat
$data = json_decode(file_get_contents("php://input"));

// spárování dat
$content->id = $data->id;

$content->distribuce_id = $data->distribuce_id;
$content->nazev = $data->nazev;
$content->soubor = $data->soubor;


if ($content->update_content()) {
    echo json_encode(
        array('message' => 'Záznam aktualizován')
    );
} else {
    echo json_encode(
        array('message' => 'Záznam není aktualizován')
    );
}
