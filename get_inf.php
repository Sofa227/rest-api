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
        $info .= "Email: " . sanitize_output($row["email"]) . "\n";
        $info .= "Balance: " . sanitize_output($row["balance"]) . "\n";
        $info .= "Correct: " . sanitize_output($row["correct"]) . "\n";
        $info .= "Limits: " . sanitize_output($row["limits"]) . "\n";
        $info .= "N_status: " . sanitize_output($row["n_status"]) . "\n";
        $info .= "N_type: " . sanitize_output($row["n_type"]) . "\n";
        $info .= "N_p_type: " . sanitize_output($row["n_p_type"]) . "\n";
        $info .= "Expense: " . sanitize_output($row["expense"]) . "\n";
        $info .= "N_service: " . sanitize_output($row["n_service"]) . "\n\n";



        // Отправляем данные клиенту в формате текста
        echo $info;
    } else {
        // Клиент с таким ID не найден
        echo "Клиент с таким ID не найден";
    }
}
?>