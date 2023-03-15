<?php

// Hlavička
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../database/database.php';
include_once '../../models/device.php';

// inicializace DB připojení
$database = new Database();
$db = $database->connect();
// inicializace třídy device
$device = new Device($db);


// využití metody pro čtení
$result = $device->read();
// kontrola zdali jsou získány data
$num = $result->rowCount();


if ($num > 0) {
    // inicializace pole pro ukládání výsledků
    $device_arr = array();

    //cyklus while pro získání dat
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {



        $device_item = array(
            'id' => $row['id'],
            'nazev' => $row['nazev'],
            'popis' => $row['popis'],
            'ip' => $row['ip'],
            'uuid' => $row['uuid'],
            'apikey' => $row['apikey'],
            'lokace_nazev' => $row['lokace_nazev'],
            'poznamka' => $row['poznamka'],
            'gps' => $row['gps']
        );


        // ukládání dat do pole
        array_push($device_arr, $device_item);
    }

    //výpis dat ve formátu json - pokud jsou nějaká
    echo json_encode($device_arr);
} else {
    // Výpis chybové hlášky pokud nebyla nalezena data
    echo json_encode(
        array('message' => 'Žádná data nebyla nalezena')
    );
}
