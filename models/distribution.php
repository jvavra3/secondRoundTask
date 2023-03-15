<?php
class Distribution
{

    // DB parametry
    private $connection;
    private $tabulka = 'distribuce';

    //parametry - tabulka distribuce
    public $id;
    public $obsah;
    public $zarizeni;
    public $cas_distribuce;






    // Constructor - db
    public function __construct($db)
    {
        $this->connection = $db;
    }


    // vytvoření distribuce - databáze
    public function create_distribution()
    {
        // vytvoření query
        $query = 'INSERT INTO ' . $this->tabulka . ' SET obsah = :obsah, zarizeni = :zarizeni, cas_distribuce = :cas_distribuce';


        $data = $this->connection->prepare($query);


        // čištění dat
        $this->obsah = htmlspecialchars(strip_tags($this->obsah));
        $this->zarizeni = htmlspecialchars(strip_tags($this->zarizeni));
        $this->cas_distribuce = htmlspecialchars(strip_tags($this->cas_distribuce));

        // bind proměnných
        $data->bindParam(':obsah', $this->obsah);
        $data->bindParam(':zarizeni', $this->zarizeni);
        $data->bindParam(':cas_distribuce', $this->cas_distribuce);


        if ($data->execute()) {
            return true;
        }

        printf("Error: %s.\n", $data->error);

        return false;
    }


    // aktualizace distribuce
    public function update_distribution()
    {

        // aktualizace query
        $query = 'UPDATE ' . $this->tabulka . ' SET obsah = :obsah, zarizeni = :zarizeni, cas_distribuce = :cas_distribuce
                                          WHERE id = :id';


        $data = $this->connection->prepare($query);



        // čištění dat
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->obsah = htmlspecialchars(strip_tags($this->obsah));
        $this->zarizeni = htmlspecialchars(strip_tags($this->zarizeni));
        $this->cas_distribuce = htmlspecialchars(strip_tags($this->cas_distribuce));

        // bind proměnných
        $data->bindParam(':id', $this->id);
        $data->bindParam(':obsah', $this->obsah);
        $data->bindParam(':zarizeni', $this->zarizeni);
        $data->bindParam(':cas_distribuce', $this->cas_distribuce);


        if ($data->execute()) {
            return true;
        }

        printf("Error: %s.\n", $data->error);

        return false;
    }


    // vymazání zařízení
    public function delete_distribution()
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
