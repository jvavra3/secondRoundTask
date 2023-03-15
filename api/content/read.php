<?php

// Hlavička
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../database/database.php';
include_once '../../models/content.php';

// inicializace DB připojení
$database = new Database();
$db = $database->connect();
// inicializace třídy content
$content = new Content($db);


// využití metody pro čtení
$result = $content->read();
// kontrola zdali jsou získány data
$num = $result->rowCount();


if ($num > 0) {
    // inicializace pole pro ukládání výsledků
    $content_arr = array();

    //cyklus while pro získání dat
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {



        $content_item = array(
            'id' => $row['id'],
            'nazev' => $row['nazev'],
            'soubor' => $row['soubor'],
            'obsah' => $row['obsah'],
            'zarizeni' => $row['zarizeni'],
            'cas_distribuce' => $row['cas_distribuce']

        );



        // ukládání dat do pole
        array_push($content_arr, $content_item);
    }

    //výpis dat ve formátu json - pokud jsou nějaká
    echo json_encode($content_arr);
} else {
    // Výpis chybové hlášky pokud nebyla nalezena data
    echo json_encode(
        array('message' => 'Žádná data nebyla nalezena')
    );
}
