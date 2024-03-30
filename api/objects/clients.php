<?php

class Clients
{
    // подключение к базе данных и таблице "Clients"
    private $conn;
    private $table_name = "Clients";

    // свойства объекта
    public $client_id;
    public $balance;
    public $limit;
    public $status;
    public $type;

    // конструктор для соединения с базой данных
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // метод для получения товаров
function read()
{
    // выбираем все записи
    $query = "SELECT
         c.client_id, c.balance, c.limit, c.status, c.type
    FROM
        " . $this->table_name . " c
        LEFT JOIN
            clients_info ci
                ON c.client_id = ci.client_id
    ORDER BY
        c.client_id DESC";

    // подготовка запроса
    $stmt = $this->conn->prepare($query);

    // выполняем запрос
    $stmt->execute();
    return $stmt;
}

function create()
{
    // запрос для вставки (создания) записей
    $query = "INSERT INTO
            " . $this->table_name . "
        SET
        client_id=:client_id, balance=:balance, limit=:limit, status=:status, type=:type";

    // подготовка запроса
    $stmt = $this->conn->prepare($query);

    // очистка
    $this->client_id = htmlspecialchars(strip_tags($this->client_id));
    $this->balance = htmlspecialchars(strip_tags($this->balance));
    $this->limit = htmlspecialchars(strip_tags($this->limit));
    $this->status = htmlspecialchars(strip_tags($this->status));
    $this->type = htmlspecialchars(strip_tags($this->type));

    // привязка значений
    $stmt->bindParam(":client_id", $this->client_id);
    $stmt->bindParam(":balance", $this->balance);
    $stmt->bindParam(":limit", $this->limit);
    $stmt->bindParam(":status", $this->status);
    $stmt->bindParam(":type", $this->type);

    // выполняем запрос
    if ($stmt->execute()) {
        return true;
    }
    return false;
}

function readOne()
{
    // запрос для чтения одной записи (клиента)
    $query = "SELECT
         c.client_id, c.balance, c.limit, c.status, c.type
    FROM
        " . $this->table_name . " c
        LEFT JOIN
            clients_info ci
                ON c.client_id = ci.client_id
        WHERE
            с.client_id = ?
        LIMIT
            0,1";
            
    // подготовка запроса
    $stmt = $this->conn->prepare($query);

    // привязываем id клиента, который будет получен
    $stmt->bindParam(1, $this->client_id);

    // выполняем запрос
    $stmt->execute();

    // получаем извлеченную строку
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // установим значения свойств объекта
    $this->client_id = $row["client_id"];
    $this->balance = $row["balance"];
    $this->limit = $row["limit"];
    $this->status = $row["status"];
    $this->type = $row["type"];
}

// метод для обновления клиента
function update()
{
    // запрос для обновления записи (клиента)
    $query = "UPDATE
            " . $this->table_name . "
        SET
        balance = :balance,
        limit = :limit,
        status = :status,
        type = :type
        WHERE
        client_id = :client_id";

    // подготовка запроса
    $stmt = $this->conn->prepare($query);

    // очистка
    $this->client_id = htmlspecialchars(strip_tags($this->client_id));
    $this->balance = htmlspecialchars(strip_tags($this->balance));
    $this->limit = htmlspecialchars(strip_tags($this->limit));
    $this->status = htmlspecialchars(strip_tags($this->status));
    $this->type = htmlspecialchars(strip_tags($this->type));

    // привязываем значения
    $stmt->bindParam(":client_id", $this->client_id);
    $stmt->bindParam(":balance", $this->balance);
    $stmt->bindParam(":limit", $this->limit);
    $stmt->bindParam(":status", $this->status);
    $stmt->bindParam(":type", $this->type);

    // выполняем запрос
    if ($stmt->execute()) {
        return true;
    }
    return false;
}

// метод для удаления клиента
function delete()
{
    // запрос для удаления записи (клиента)
    $query = "DELETE FROM " . $this->table_name . " WHERE client_id = ?";

    // подготовка запроса
    $stmt = $this->conn->prepare($query);

    // очистка
    $this->client_id = htmlspecialchars(strip_tags($this->client_id));

    // привязываем id записи для удаления
    $stmt->bindParam(1, $this->client_id);

    // выполняем запрос
    if ($stmt->execute()) {
        return true;
    }
    return false;
}
function search($keywords)
{
    // поиск записей (клиентов) по " id клиента", "статусу", "типу"
    $query = "SELECT
            ci.client_id, c.client_id, c.balance, c.limit, c.status, c.type
        FROM
            " . $this->table_name . " c
            LEFT JOIN
            clients_info ci
                    ON c.client_id = ci.client_id
        WHERE
            ci.client_id LIKE ? OR c.status LIKE ? OR c.type LIKE ?
        ORDER BY
            ci.client_id DESC";

    // подготовка запроса
    $stmt = $this->conn->prepare($query);

    // очистка
    $keywords = htmlspecialchars(strip_tags($keywords));
    $keywords = "%{$keywords}%";

    // привязка
    $stmt->bindParam(1, $keywords);
    $stmt->bindParam(2, $keywords);
    $stmt->bindParam(3, $keywords);

    // выполняем запрос
    $stmt->execute();

    return $stmt;
}

// получение товаров с пагинацией
public function readPaging($from_record_num, $records_per_page)
{
    // выборка
    $query = "SELECT
            ci.client_id, c.client_id, c.balance, c.limit, c.status, c.type
        FROM
            " . $this->table_name . " c
            LEFT JOIN
            clients_info ci
            ON c.client_id = ci.client_id
        ORDER BY ci.client_id DESC
        LIMIT ?, ?";

    // подготовка запроса
    $stmt = $this->conn->prepare($query);

    // свяжем значения переменных
    $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
    $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);

    // выполняем запрос
    $stmt->execute();

    // вернём значения из базы данных
    return $stmt;
}

// данный метод возвращает кол-во клиентов
public function count()
{
    $query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name . "";

    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    return $row["total_rows"];
}
}
?>