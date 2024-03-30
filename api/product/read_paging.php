<?php

// установим HTTP-заголовки
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// подключение файлов
include_once "../config/core.php";
include_once "../shared/utilities.php";
include_once "../config/database.php";
include_once "../objects/clients.php";

// utilities
$utilities = new Utilities();

// создание подключения
$database = new Database();
$db = $database->getConnection();

// инициализация объекта
$clients = new Clients($db);

// запрос товаров
$stmt = $clients->readPaging($from_record_num, $records_per_page);
$num = $stmt->rowCount();

// если больше 0 записей
if ($num > 0) {

    // массив товаров
    $clients_arr = array();
    $clients_arr["records"] = array();
    $clients_arr["paging"] = array();

    // получаем содержимое нашей таблицы
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        // извлечение строки
        extract($row);
        $clients_item = array(
            "client_id" => $client_id,
            "balance" => $balance,
            "limit" => $limit,
            "status" => $status,
            "type" => $type
        );
        array_push($clients_arr["records"], $clients_item);
    }

    // подключим пагинацию
    $total_rows = $clients->count();
    $page_url = "{$home_url}clients/read_paging.php?";
    $paging = $utilities->getPaging($page, $total_rows, $records_per_page, $page_url);
    $clients_arr["paging"] = $paging;

    // установим код ответа - 200 OK
    http_response_code(200);

    // вывод в json-формате
    echo json_encode($clients_arr);
} else {

    // код ответа - 404 Ничего не найдено
    http_response_code(404);

    // сообщим пользователю, что клиентов не существует
    echo json_encode(array("message" => "Клиенты не найдены"), JSON_UNESCAPED_UNICODE);
}