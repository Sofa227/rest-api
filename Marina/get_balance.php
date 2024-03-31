<?php
// Подключение к базе данных
$host = 'localhost';
$dbname = 'billing_db';
$username = 'root';
$password = '';

        // Функция для безопасного вывода
        function sanitize_output($string) {
            return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
        }

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Ошибка подключения к базе данных: " . $e->getMessage());
}

// Получение значения ID клиента из GET-параметра
$id = isset($_GET['id']) ? $_GET['id'] : null;

if ($id !== null) {
    // Запрос к базе данных для получения информации о клиенте
    $query = "SELECT * FROM clients WHERE id = :id"; // Замените 'your_table_name' на имя вашей таблицы
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // Проверяем, что данные были получены
    if ($row) {
        // Формирование информации для вывода
        $info = "";
        $info .= "Balance: " . sanitize_output($row["balance"]) . "\n";




        // Отправляем данные клиенту в формате текста
        echo $info;
    } else {
        // Клиент с таким ID не найден
        echo "Клиент с таким ID не найден";
    }
}
?>