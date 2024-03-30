<?php

// HTTP-заголовки
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// подключение необходимых файлов
include_once "../config/core.php";
include_once "../config/database.php";
include_once "../objects/search.php";

// создание подключения к БД
$database = new Database();
$db = $database->getConnection();

// инициализируем объект
$clients = new Clients($db);

// получаем ключевые слова
$keywords = isset($_GET["s"]) ? $_GET["s"] : "";

// запрос товаров
$stmt = $clients->search($keywords);
$num = $stmt->rowCount();

// проверяем, найдено ли больше 0 записей
if ($num > 0) {
    // массив клиентов
    $clients_arr = array();
    $clients_arr["records"] = array();

    // получаем содержимое нашей таблицы
    // fetch() быстрее чем fetchAll()
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        // извлечём строку
        extract($row);
        $clients_item = array(
            "client_id" => $client_id,
            "balance" => $balance,
            "limit" => $limit,
            "status" => $status,
            "type" => $type,
        );
        array_push($clients_arr["records"], $clients_item);
    }
    // код ответа - 200 OK
    http_response_code(200);

    // покажем клиентов
    echo json_encode($clients_arr);
} else {
    // код ответа - 404 Ничего не найдено
    http_response_code(404);

    // скажем пользователю, что клиенты не найдены
    echo json_encode(array("message" => "Клиенты не найдены."), JSON_UNESCAPED_UNICODE);
}