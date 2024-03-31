<?php 
error_reporting(E_ALL ^ E_NOTICE);
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email']; // Получаем email клиента из формы
    
    if (isset($_POST['deletePayment'])) {
        // Удаление последнего платежа
        $sql_delete_payment = "DELETE FROM clients WHERE email = '$email' ORDER BY id DESC LIMIT 1";
        mysqli_query($connection, $sql_delete_payment);
    }
    
    if (isset($_POST['deleteExpense'])) {
        // Удаление последнего расхода
        $sql_delete_expense = "DELETE FROM clients WHERE email = '$email' ORDER BY id DESC LIMIT 1";
        mysqli_query($connection, $sql_delete_expense);
    }
    
    if (isset($_POST['addPayment'])) {
        $paymentType = $_POST['clientPaymentNew'];
        $amount = $_POST['addIngo'];
        
        // Добавление платежа
        $sql_add_payment = "INSERT INTO clients (email, n_p_type, amount) VALUES ('$email', '$paymentType', '$amount')";
        mysqli_query($connection, $sql_add_payment);
    }
    
    if (isset($_POST['addExpense'])) {
        $serviceType = $_POST['clientServiceNew'];
        $amount = $_POST['addOutgo'];
        
        // Добавление расхода
        $sql_add_expense = "INSERT INTO clients (email, n_service, amount) VALUES ('$email', '$serviceType', '$amount')";
        mysqli_query($connection, $sql_add_expense);
    }
}
?>
