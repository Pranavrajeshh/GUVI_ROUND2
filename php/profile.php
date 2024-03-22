<?php
include('connection.php');
require_once '../vendor/autoload.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['username'])) {
        $username = $_POST['username'];
        $filter = ['username' => $username];
       $updateData = [
    '$set' => [
        'age' => $_POST['age'],
        'location' => $_POST['location'],
        'nation' => $_POST['nation']
    ]
];
        $result = $userCollection->updateOne($filter, $updateData, ['upsert' => true]);
        if ($result->getModifiedCount() > 0) {
            echo "User data updated successfully!";
        } else {
            echo "Failed to update user data.";
        }
    } else {
        echo "Username parameter is not set.";
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['username'])) {
        $username = $_GET['username'];
        $userInfo = $userCollection->findOne(['username' => $username]);
        if ($userInfo) {
            echo json_encode($userInfo);
        } else {
            echo json_encode(['error' => 'User not found']);
        }
    } else {
        echo "Username parameter is not set.";
    }
} else {
    echo "Invalid request method.";
}
?>