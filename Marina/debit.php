<?php
// Подключение к базе данных
$host = 'localhost';
$dbname = 'billing_db';
$username = 'root';
$password = '';
$servername = 'localhost';

// Создание соединения
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Получение текущей даты
$currentDate = date('Y-m-d');

// Получение списка клиентов, где услуга должна быть списана сегодня
$sql = "SELECT * FROM debit_schedule WHERE next_debit_date <= '$currentDate'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $email = $row['email'];

        // Получение информации о клиенте из базы данных
        $clientSql = "SELECT * FROM clients WHERE email = '$email'";
        $clientResult = $conn->query($clientSql);

        if ($clientResult->num_rows > 0) {
            $clientRow = $clientResult->fetch_assoc();
            $clientId = $clientRow['id'];
            $balance = $clientRow['balance'];
            $service = $clientRow['n_service'];

            // Определение стоимости услуги
            switch ($service) {
                case 'Видеонаблюдение':
                    $serviceCost = 100; // Пример стоимости услуги
                    break;
                case 'Домофония':
                    $serviceCost = 50;
                    break;
                // Другие услуги и их стоимость
                default:
                    continue 2; // Пропустить эту запись, если услуга не распознана
            }

            // Проверка баланса клиента
            if ($balance >= $serviceCost) {
                // Выполнение списания
                $updatedBalance = $balance - $serviceCost;
                $clientUpdateSql = "UPDATE clients SET balance = $updatedBalance WHERE id = $clientId";
                if ($conn->query($clientUpdateSql) === TRUE) {
                    echo "Средства успешно списаны за услугу: $service у клиента с email: $email<br>";
                } else {
                    echo "Ошибка при списании средств: " . $conn->error . "<br>";
                }
            } else {
                echo "Недостаточно средств на балансе у клиента с email: $email<br>";
            }
        } else {
            echo "Клиент с email: $email не найден<br>";
        }

        // Обновление даты следующего списания на следующий месяц
        $nextDebitDate = date('Y-m-d', strtotime('+1 month'));
        $scheduleUpdateSql = "UPDATE debit_schedule SET next_debit_date = '$nextDebitDate' WHERE email = '$email'";
        $conn->query($scheduleUpdateSql);
    }
} else {
    echo "Нет клиентов для списания сегодня<br>";
}

$conn->close();
?>