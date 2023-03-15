<?php
class Location
{

    // DB parametry
    private $connection;
    private $tabulka = 'lokace';

    //parametry - tabulka lokace
    public $id;
    public $nazev;
    public $poznamka;
    public $gps;






    // Constructor - db
    public function __construct($db)
    {
        $this->connection = $db;
    }


    // vytvoření lokace - databáze
    public function create_location()
    {
        // vytvoření query
        $query = 'INSERT INTO ' . $this->tabulka . ' SET nazev = :nazev, poznamka = :poznamka, gps = :gps';


        $data = $this->connection->prepare($query);


        // čištění dat
        $this->nazev = htmlspecialchars(strip_tags($this->nazev));
        $this->poznamka = htmlspecialchars(strip_tags($this->poznamka));
        $this->gps = htmlspecialchars(strip_tags($this->gps));

        // bind proměnných
        $data->bindParam(':nazev', $this->nazev);
        $data->bindParam(':poznamka', $this->poznamka);
        $data->bindParam(':gps', $this->gps);


        if ($data->execute()) {
            return true;
        }

        printf("Error: %s.\n", $data->error);

        return false;
    }


    // aktualizace lokace
    public function update_location()
    {

        // aktualizace query
        $query = 'UPDATE ' . $this->tabulka . ' SET nazev = :nazev, poznamka = :poznamka, gps = :gps
                                          WHERE id = :id';


        $data = $this->connection->prepare($query);



        // čištění dat
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->nazev = htmlspecialchars(strip_tags($this->nazev));
        $this->poznamka = htmlspecialchars(strip_tags($this->poznamka));
        $this->gps = htmlspecialchars(strip_tags($this->gps));



        // bind proměnných
        $data->bindParam(':id', $this->id);
        $data->bindParam(':nazev', $this->nazev);
        $data->bindParam(':poznamka', $this->poznamka);
        $data->bindParam(':gps', $this->gps);


        if ($data->execute()) {
            return true;
        }

        printf("Error: %s.\n", $data->error);

        return false;
    }


    // vymazání lokace
    public function delete_location()
    {

        // aktualizace query
        $query = 'DELETE FROM ' . $this->tabulka . ' WHERE id = :id';


        $data = $this->connection->prepare($query);

        // čištění dat
        $this->id = htmlspecialchars(strip_tags($this->id));


        // bind proměnných
        $data->bindParam(':id', $this->id);


        if ($data->execute()) {
            return true;
        }

        printf("Error: %s.\n", $data->error);

        return false;
    }
}
