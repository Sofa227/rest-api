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

// Получение значения email клиента из GET-параметра
$email = isset($_GET['email']) ? $_GET['email'] : null;

if ($email !== null) {
    // Запрос к базе данных для получения информации о клиенте по email
    $query = "SELECT * FROM clients WHERE email = :email";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // Проверяем, что данные были получены
    if ($row) {
        // Формирование информации для вывода
        $info = "";
        $info .= "N_status: " . sanitize_output($row["n_status"]) . "\n";

        // Отправляем данные клиенту в формате текста
        echo $info;
    } else {
        // Клиент с таким email не найден
        echo "Клиент с таким email не найден";
    }
}

?>