<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['name'];
    $password = $_POST['password'];

    if (is_numeric($password)) {
        $hashedPassword = $password;
    } else {        
        $hashedPassword = sha1($password);
    }

    $conn = mysqli_connect("localhost", "root", "", "pranav");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $stmt = $conn->prepare("SELECT * FROM user WHERE username = ?");
    $stmt->bind_param("s", $username);

    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        if ($hashedPassword===$row['password']) {
            echo "LOGGED IN SUCCESSFULLY";
        } else {
            echo $row['password'];
            echo "Invalid username or password.";
            echo $HashedPassword;
        }
    } else {
        echo "User does not exist.";
    }
    $stmt->close();
    $conn->close();
}
?>

