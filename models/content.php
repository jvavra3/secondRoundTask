<?php
class Content
{

    // DB parametry
    private $connection;
    private $tabulka = 'obsah';

    //parametry - tabulka obsah
    public $id;
    public $distribuce_id;
    public $nazev;
    public $soubor;

    //parametry - tabulka distribuce
    public $obsah;
    public $zarizeni;
    public $cas_distribuce;



    // Constructor - db
    public function __construct($db)
    {
        $this->connection = $db;
    }


    public function read()
    {
        // Vytvoření SQL query
        //  z.distribuce_id, 
        $query = 'SELECT 
                o.id,
                o.nazev, 
                o.soubor, 

                d.obsah, 
                d.zarizeni,
                d.cas_distribuce
            FROM ' . $this->tabulka . ' o
            LEFT JOIN
            distribuce d ON o.distribuce_id = d.id';


        $stmt = $this->connection->prepare($query);
        $stmt->execute();

        return $stmt;
    }


    // vytvoření obsah - databáze
    public function create_content()
    {
        // vytvoření query
        $query = 'INSERT INTO ' . $this->tabulka . ' SET distribuce_id  = :distribuce_id , nazev = :nazev, soubor = :soubor';

        $data = $this->connection->prepare($query);


        // čištění dat
        $this->distribuce_id = htmlspecialchars(strip_tags($this->distribuce_id));
        $this->nazev = htmlspecialchars(strip_tags($this->nazev));
        $this->soubor = htmlspecialchars(strip_tags($this->soubor));


        // bind proměnných
        $data->bindParam(':distribuce_id', $this->distribuce_id);
        $data->bindParam(':nazev', $this->nazev);
        $data->bindParam(':soubor', $this->soubor);

        if ($data->execute()) {
            return true;
        }

        printf("Error: %s.\n", $data->error);

        return false;
    }


    // aktualizace obsahu
    public function update_content()
    {

        // aktualizace query
        $query = 'UPDATE ' . $this->tabulka . ' SET distribuce_id = :distribuce_id, nazev = :nazev, soubor = :soubor
                                          WHERE id = :id';


        $data = $this->connection->prepare($query);



        // čištění dat
        $this->distribuce_id = htmlspecialchars(strip_tags($this->distribuce_id));
        $this->nazev = htmlspecialchars(strip_tags($this->nazev));
        $this->soubor = htmlspecialchars(strip_tags($this->soubor));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // bind proměnných
        $data->bindParam(':distribuce_id', $this->distribuce_id);
        $data->bindParam(':nazev', $this->nazev);
        $data->bindParam(':soubor', $this->soubor);
        $data->bindParam(':id', $this->id);


        if ($data->execute()) {
            return true;
        }

        printf("Error: %s.\n", $data->error);

        return false;
    }


    // vymazání obsahu
    public function delete_content()
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
