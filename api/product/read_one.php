<?php

// необходимые HTTP-заголовки
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json");

// подключение файла для соединения с базой и файл с объектом
include_once "../config/database.php";
include_once "../objects/clients.php";

// получаем соединение с базой данных
$database = new Database();
$db = $database->getConnection();

// подготовка объекта
$clients = new Clients($db);

// установим свойство ID записи для чтения
$clients->client_id = isset($_GET["client_id"]) ? $_GET["client_id"] : die();

// получим детали товара
$clients->readOne();

if ($clients->name != null) {

    // создание массива
    $clients_arr = array(
        "client_id" =>  $clients->client_id,
        "balance" => $clients->balance,
        "limit" => $clients->limit,
        "status" => $clients->status,
        "type" => $clients->type,
    );

    // код ответа - 200 OK
    http_response_code(200);

    // вывод в формате json
    echo json_encode($clients_arr);
} else {
    // код ответа - 404 Не найдено
    http_response_code(404);

    // сообщим пользователю, что такой клиент не существует
    echo json_encode(array("message" => "Клиент не существует"), JSON_UNESCAPED_UNICODE);
}