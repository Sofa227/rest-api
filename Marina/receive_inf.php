<?php
// Подключение к базе данных
include 'config.php';

// Функция для защиты от XSS-атак
function sanitize_output($buffer) {
    return htmlspecialchars($buffer, ENT_QUOTES, 'UTF-8');
}

// SQL запрос для получения информации о клиенте
$sql = "SELECT email, balance, correct, limits, n_status, n_type, n_p_type, expense, n_service FROM clients";

// Выполнение запроса
$result = $conn->query($sql);

// Проверка наличия результатов
if ($result && $result->num_rows > 0) {
    // Формирование строки для вывода информации
    $info = "";
    while ($row = $result->fetch_assoc()) {
        $info .= "Email: " . sanitize_output($row["email"]) . "\n";
        $info .= "Balance: " . sanitize_output($row["balance"]) . "\n";
        $info .= "Correct: " . sanitize_output($row["correct"]) . "\n";
        $info .= "Limits: " . sanitize_output($row["limits"]) . "\n";
        $info .= "N_status: " . sanitize_output($row["n_status"]) . "\n";
        $info .= "N_type: " . sanitize_output($row["n_type"]) . "\n";
        $info .= "N_p_type: " . sanitize_output($row["n_p_type"]) . "\n";
        $info .= "Expense: " . sanitize_output($row["expense"]) . "\n";
        $info .= "N_service: " . sanitize_output($row["n_service"]) . "\n\n";
    }
} else {
    $info = "0 results";
}

// Закрываем соединение с базой данных
$conn->close();

// Возвращаем информацию
echo $info;
?>
