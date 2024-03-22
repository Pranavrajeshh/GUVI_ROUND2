<?php
require_once '../vendor/autoload.php';
    $db_server = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "pranav";
    try {
        $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
    } catch (mysqli_sql_exception $e) {
        echo "MySQL connection failed: " . $e->getMessage();
    }
    $databaseConnection = new MongoDB\Client();
    $myDatabase = $databaseConnection->pranav;
    $userCollection = $myDatabase->user;