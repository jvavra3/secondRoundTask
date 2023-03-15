<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
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

// id pro vymazání
$distribution->id = $data->id;

// vymazání
if ($distribution->delete_distribution()) {
    echo json_encode(
        array('message' => 'Smazaný záznam')
    );
} else {
    echo json_encode(
        array('message' => 'Záznam není smazán')
    );
}
