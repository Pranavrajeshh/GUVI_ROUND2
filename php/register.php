<?php
    require_once '../vendor/autoload.php';
    include('connection.php');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['name'];
        $password = sha1($_POST['password']);
        $stmt = $conn->prepare("INSERT INTO user (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $password); 
        if ($stmt->execute()) {
            $document = array(
                "username" => $username,
                "password" => $password
            );
            $userCollection->insertOne($document);
            echo "New record created successfully";
        } else {
            echo "Error:user already exists";
        }
        $stmt->close();
    }
    $conn->close();
?>