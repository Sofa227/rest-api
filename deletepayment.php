<?php 
error_reporting(E_ALL ^ E_NOTICE);
include 'config.php';

// Проверяем, был ли запрос на удаление клиента
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql_select_n_p_type = "SELECT n_p_type FROM clients WHERE email = '$email'";
    $result = mysqli_query($connection, $sql_select_n_p_type);
    $row = mysqli_fetch_assoc($result);
    $n_p_type = $row['n_p_type'];
    
    // Удаление записей по n_p_type
    $sql_delete_n_p_type = "DELETE FROM clients WHERE n_p_type = '$n_p_type'";
    mysqli_query($connection, $sql_delete_n_p_type);
}

$conn->close();
?>
