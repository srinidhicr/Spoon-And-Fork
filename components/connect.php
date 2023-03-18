<?php

$db_name = 'mysql:host=127.0.0.1;dbname=food_db';
$user_name = 'root';
$user_password = '';

try {
    $conn = new PDO($db_name, $user_name, $user_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

?>
