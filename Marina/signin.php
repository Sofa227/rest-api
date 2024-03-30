<?php error_reporting (E_ALL ^ E_NOTICE);
session_start();
include 'config.php';

$signin_login = $_POST['signin_login'];
$signin_password = $_POST['signin_password'];
$sql = "SELECT login from emloyee_logins WHERE login=\"{$signin_login}\" AND password=\"{$signin_password}\"";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if ($result->num_rows > 0) {
    $_SESSION["is_auth"] = true;
    $_SESSION["login"] = $row['login'];
    include 'main_window.php';
    }
else {
    echo "Пользователь не найден";
}

$conn->close();
?>