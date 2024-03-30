<?php

// установим HTTP-заголовки
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// подключение файлов для соединения с БД и файл с объектом Clients_info
include_once "../config/database.php";
include_once "../objects/category.php";

// создание подключения к базе данных
$database = new Database();
$db = $database->getConnection();

// инициализация объекта
$clients_info = new Clients_info($db);

// получаем клиентов
$stmt = $category->readAll();
$num = $stmt->rowCount();

// проверяем, найдено ли больше 0 записей
if ($num > 0) {

    // массив для записей
    $clients_info_arr = array();
    $clients_info_arr["records"] = array();

    // получим содержимое нашей таблицы
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        // извлекаем строку
        extract($row);
        $clients_info_item = array(
            "client_id" => $client_id,
            "FIO" => $FIO,
            "phone_number" => $phone_number
        );
        array_push($clients_info_arr["records"], $clients_info_item);
    }
    // код ответа - 200 OK
    http_response_code(200);

    // покажем данные категорий в формате json
    echo json_encode($clients_info_arr);
} else {

    // код ответа - 404 Ничего не найдено
    http_response_code(404);

    // сообщим пользователю, что клиенты не найдены
    echo json_encode(array("message" => "Клиенты не найдены"), JSON_UNESCAPED_UNICODE);
}