<?php

class Clients_info
{
    // соединение с БД и таблицей "clients_info"
    private $conn;
    private $table_name = "clients_info";

    // свойства объекта
    public $client_id;
    public $name_org;
    public $FIO;
    public $phone_number;
    public $email;
    public $dbirthday;
    public $address;



    public function __construct($db)
    {
        $this->conn = $db;
    }

// метод для получения всех категорий товаров
public function readAll()
{
    $query = "SELECT
                client_id, FIO, phone_number
            FROM
                " . $this->table_name . "
            ORDER BY
            FIO";

    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    return $stmt;
}
}