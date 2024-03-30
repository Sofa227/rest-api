<?php

// HTTP-заголовки
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// подключаем файл для работы с БД и объектом Product
include_once "../config/database.php";
include_once "../objects/clients.php";

// получаем соединение с базой данных
$database = new Database();
$db = $database->getConnection();

// подготовка объекта
$clients = new Clients($db);

// получаем id клиента для редактирования
$data = json_decode(file_get_contents("php://input"));

// установим id свойства клиента для редактирования
$clients->client_id = $data->client_id;

// установим значения свойств клиента
$clients->balance = $data->balance;
$clients->limit = $data->limit;
$clients->status = $data->status;
$clients->type = $data->type;

// обновление клиента
if ($clients->update()) {
    // установим код ответа - 200 ok
    http_response_code(200);

    // сообщим пользователю
    echo json_encode(array("message" => "Клиент был обновлён"), JSON_UNESCAPED_UNICODE);
}
// если не удается обновить клиента, сообщим пользователю
else {
    // код ответа - 503 Сервис не доступен
    http_response_code(503);

    // сообщение пользователю
    echo json_encode(array("message" => "Невозможно обновить клиента"), JSON_UNESCAPED_UNICODE);
}