<?php error_reporting (E_ALL ^ E_NOTICE);
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получение данных из формы
    $clientOrganisation = $_POST['clientOrganisation'];
    $clientName = $_POST['clientName'];
    $clientSurname = $_POST['clientSurname'];
    $clientPatronymic = $_POST['clientPatronymic'];
    $clientTelephon = $_POST['clientTelephon'];
    $clientEmail = $_POST['clientEmail'];
    $clientDateOfBirth = $_POST['clientDateOfBirth'];
    $clientAddress = $_POST['clientAddress'];

    // SQL запрос для вставки данных в таблицу
    $sql1 = "INSERT INTO clientemails (email)
    VALUES ('$clientEmail')";
    $sql2 = "INSERT INTO clientnames (email, f_name, name, s_name)
    VALUES ( '$clientEmail','$clientName', '$clientSurname', '$clientPatronymic')";
    $sql3 = "INSERT INTO clientbirthdates (email, data_b)
    VALUES ('$clientEmail','$clientDateOfBirth')";
    
    $sql4 = "INSERT INTO clientcontacts (email, name_org)
    VALUES ('$clientEmail', '$clientOrganisation')";
    $sql5 = "INSERT INTO clientphone (email, ph_number)
    VALUES ('$clientEmail', '$clientTelephon')";
    $sql6 = "INSERT INTO clientaddresses (email, conn_a)
    VALUES ('$clientEmail', '$clientAddress')";
    

    if ($conn->query($sql1) === TRUE && $conn->query($sql2) === TRUE && $conn->query($sql3) === TRUE && $conn->query($sql4) === TRUE && $conn->query($sql5) === TRUE && $conn->query($sql6) === TRUE) {
        echo "New record created successfully";
        header("Location: main_window.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $query = "UPDATE clients SET balance = ?, correction = ?, limit = ?, status = ?, type = ?, next_payment = ?, expenses = ?, service_with_periodic_payments = ? WHERE client_id = ?";

}

$conn->close();

?>