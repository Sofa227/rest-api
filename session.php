<?php
session_start();
session_destroy();
session_unset();
include('main_window.php');
?>