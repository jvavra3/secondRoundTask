<?php
class Device
{

  // DB parametry
  private $connection;
  private $tabulka = 'zarizeni';

  //parametry - tabulka zařízení
  public $id;
  public $nazev;
  public $popis;
  public $ip;
  public $uuid;
  public $lokace_id;
  public $apikey;

  //parametry - tabulka lokace
  public $nazev_loc;
  public $poznamka;
  public $gps;



  // Constructor - db
  public function __construct($db)
  {
    $this->connection = $db;
  }


  public function read()
  {
    // Vytvoření SQL query
    //  z.lokace_id, 
    $query = 'SELECT 
                z.id,
                z.nazev, 
                z.popis, 
                z.ip, 
                z.uuid,
                z.apikey,
                l.nazev as lokace_nazev, 
                l.poznamka,
                l.gps
            FROM ' . $this->tabulka . ' z
            LEFT JOIN
            lokace l ON z.lokace_id = l.id';


    $data = $this->connection->prepare($query);
    $data->execute();

    return $data;
  }



  // vytvoření zařízení - databáze
  public function create_device()
  {
    // vytvoření query
    $query = 'INSERT INTO ' . $this->tabulka . ' SET nazev = :nazev, popis = :popis, ip = :ip, uuid	 = :uuid, lokace_id  = :lokace_id, apikey  = :apikey';


    $data = $this->connection->prepare($query);


    // čištění dat
    $this->nazev = htmlspecialchars(strip_tags($this->nazev));
    $this->popis = htmlspecialchars(strip_tags($this->popis));
    $this->ip = htmlspecialchars(strip_tags($this->ip));
    $this->uuid = htmlspecialchars(strip_tags($this->uuid));
    $this->lokace_id = htmlspecialchars(strip_tags($this->lokace_id));
    $this->apikey = htmlspecialchars(strip_tags($this->apikey));

    // bind proměnných
    $data->bindParam(':nazev', $this->nazev);
    $data->bindParam(':popis', $this->popis);
    $data->bindParam(':ip', $this->ip);
    $data->bindParam(':uuid', $this->uuid);
    $data->bindParam(':lokace_id', $this->lokace_id);
    $data->bindParam(':apikey', $this->apikey);

    if ($data->execute()) {
      return true;
    }

    printf("Error: %s.\n", $data->error);

    return false;
  }


  // aktualizace zařízení
  public function update_device()
  {

    // aktualizace query
    $query = 'UPDATE ' . $this->tabulka . ' SET nazev = :nazev, popis = :popis, ip = :ip, uuid	 = :uuid, lokace_id  = :lokace_id, apikey  = :apikey
                                          WHERE id = :id';


    $data = $this->connection->prepare($query);



    // čištění dat
    $this->id = htmlspecialchars(strip_tags($this->id));
    $this->nazev = htmlspecialchars(strip_tags($this->nazev));
    $this->popis = htmlspecialchars(strip_tags($this->popis));
    $this->ip = htmlspecialchars(strip_tags($this->ip));
    $this->uuid = htmlspecialchars(strip_tags($this->uuid));
    $this->lokace_id = htmlspecialchars(strip_tags($this->lokace_id));
    $this->apikey = htmlspecialchars(strip_tags($this->apikey));

    // bind proměnných
    $data->bindParam(':id', $this->id);
    $data->bindParam(':nazev', $this->nazev);
    $data->bindParam(':popis', $this->popis);
    $data->bindParam(':ip', $this->ip);
    $data->bindParam(':uuid', $this->uuid);
    $data->bindParam(':lokace_id', $this->lokace_id);
    $data->bindParam(':apikey', $this->apikey);

    if ($data->execute()) {
      return true;
    }

    printf("Error: %s.\n", $data->error);

    return false;
  }


  // vymazání zařízení
  public function delete_device()
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
