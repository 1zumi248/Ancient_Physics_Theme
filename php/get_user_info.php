<?php
session_start();
header('Content-Type: application/json');

$response = [
    'username' => isset($_SESSION['username']) ? $_SESSION['username'] : null,
    'isAdmin' => isset($_SESSION['isAdmin']) ? $_SESSION['isAdmin'] : false
];

echo json_encode($response);
?> 