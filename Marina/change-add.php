<?php
// Подключение к базе данных
$servername = "localhost"; // Имя сервера базы данных
$username = "root"; // Имя пользователя базы данных
$password = ""; // Пароль пользователя базы данных
$dbname = "billing_db"; // Имя базы данных

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Установка режима ошибок PDO на исключения
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Ошибка подключения к базе данных: " . $e->getMessage();
}

// Обработка формы
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получение данных из формы
    $clientEmail = $_POST['clientEmail'];
    $clientBalance = $_POST['clientBalance'];
    $clientCorrection = $_POST['clientCorrection'];
    $clientLimit = $_POST['clientLimit'];
    $clientStatus = $_POST['clientStatus'];
    $clientType = $_POST['clientType'];
    $clientPayment = $_POST['clientPayment'];
    $clientOutgoes = $_POST['clientOutgoes'];
    $clientService = $_POST['clientService'];

    try {
        // Проверка наличия клиента в базе данных
        $stmt = $conn->prepare("SELECT * FROM clients WHERE email = :clientEmail");
        $stmt->bindParam(':clientEmail', $clientEmail);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            // Если клиент существует, обновляем данные
            $stmt = $conn->prepare("UPDATE clients SET balance = :clientBalance, correct = :clientCorrection, limits = :clientLimit, n_status = :clientStatus, n_type = :clientType, n_p_type = :clientPayment, expense = :clientOutgoes, n_service = :clientService WHERE email = :clientEmail");
            $stmt->bindParam(':clientBalance', $clientBalance);
            $stmt->bindParam(':clientCorrection', $clientCorrection);
            $stmt->bindParam(':clientLimit', $clientLimit);
            $stmt->bindParam(':clientStatus', $clientStatus);
            $stmt->bindParam(':clientType', $clientType);
            $stmt->bindParam(':clientPayment', $clientPayment);
            $stmt->bindParam(':clientOutgoes', $clientOutgoes);
            $stmt->bindParam(':clientService', $clientService);
            $stmt->bindParam(':clientEmail', $clientEmail);
            $stmt->execute();
            echo "Данные клиента успешно обновлены.";
        } else {
            // Если клиент не существует, создаем нового клиента
            $stmt = $conn->prepare("INSERT INTO clients (email, balance, correct, limits, n_status, n_type, n_p_type, expense, n_service) VALUES (:clientEmail, :clientBalance, :clientCorrection, :clientLimit, :clientStatus, :clientType, :clientPayment, :clientOutgoes, :clientService)");
            $stmt->bindParam(':clientEmail', $clientEmail);
            $stmt->bindParam(':clientBalance', $clientBalance);
            $stmt->bindParam(':clientCorrection', $clientCorrection);
            $stmt->bindParam(':clientLimit', $clientLimit);
            $stmt->bindParam(':clientStatus', $clientStatus);
            $stmt->bindParam(':clientType', $clientType);
            $stmt->bindParam(':clientPayment', $clientPayment);
            $stmt->bindParam(':clientOutgoes', $clientOutgoes);
            $stmt->bindParam(':clientService', $clientService);
            $stmt->execute();
            echo "Новый клиент успешно добавлен.";
        }
    } catch(PDOException $e) {
        echo "Ошибка при обновлении/добавлении информации о клиенте: " . $e->getMessage();
    }
}
?>